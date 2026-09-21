<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Perfume;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StorefrontController extends Controller
{
    public function collection(Request $request): View
    {
        $activeAudience = $request->string('audience')->toString();
        if (! in_array($activeAudience, ['women', 'men', 'unisex'], true)) {
            $activeAudience = '';
        }

        return view('storefront.collection', [
            'perfumes' => Perfume::with('category')->where('is_active', true)->latest()->get(),
            'activeAudience' => $activeAudience,
        ]);
    }

    public function about(): View
    {
        return view('storefront.about');
    }

    public function cart(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $perfumes = Perfume::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $items = collect($cart)->map(function ($quantity, $id) use ($perfumes) {
            $perfume = $perfumes->get($id);

            if (! $perfume) {
                return null;
            }

            return [
                'perfume' => $perfume,
                'quantity' => $quantity,
                'subtotal' => (float) $perfume->current_price * $quantity,
            ];
        })->filter();

        return view('storefront.cart', [
            'items' => $items,
            'subtotal' => $items->sum('subtotal'),
        ]);
    }

    public function addToCart(Request $request, Perfume $perfume): RedirectResponse|JsonResponse
    {
        abort_unless($perfume->is_active, 404);

        if ($perfume->stock < 1) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $perfume->name.' is currently sold out.'], 422);
            }

            return back()->with('error', $perfume->name.' is currently sold out.');
        }

        $cart = $request->session()->get('cart', []);
        $currentQuantity = $cart[$perfume->id] ?? 0;
        $cart[$perfume->id] = min($currentQuantity + 1, $perfume->stock);
        $request->session()->put('cart', array_filter($cart));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $perfume->name.' was added to your bag.',
                'cartCount' => collect($cart)->sum(),
            ]);
        }

        return back()->with('success', $perfume->name.' was added to your bag.');
    }

    public function updateCart(Request $request): RedirectResponse
    {
        $quantities = $request->validate(['quantities' => ['array']])['quantities'] ?? [];
        $perfumes = Perfume::whereIn('id', array_keys($quantities))->get()->keyBy('id');
        $cart = collect($quantities)->mapWithKeys(function ($quantity, $id) use ($perfumes) {
            $perfume = $perfumes->get($id);
            $quantity = max(0, (int) $quantity);

            return $perfume && $quantity ? [$id => min($quantity, $perfume->stock)] : [];
        })->all();

        $request->session()->put('cart', $cart);

        return back()->with('success', 'Your bag has been updated.');
    }

    public function removeFromCart(Request $request, Perfume $perfume): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$perfume->id]);
        $request->session()->put('cart', $cart);

        return back()->with('success', 'Item removed from your bag.');
    }

    public function checkout(Request $request): View|RedirectResponse
    {
        if (empty($request->session()->get('cart', []))) {
            return redirect()->route('cart')->with('error', 'Add a perfume to your bag before ordering.');
        }

        return view('storefront.checkout');
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        $order = DB::transaction(function () use ($cart) {
            $perfumes = Perfume::whereIn('id', array_keys($cart))->lockForUpdate()->get()->keyBy('id');
            $items = collect($cart)->map(function ($quantity, $id) use ($perfumes) {
                $perfume = $perfumes->get($id);
                $quantity = (int) $quantity;

                abort_unless($perfume && $perfume->is_active && $quantity > 0 && $perfume->stock >= $quantity, 422, 'One of your selected perfumes is no longer available in that quantity.');

                return ['perfume' => $perfume, 'quantity' => $quantity];
            });

            $total = $items->sum(fn ($item) => (float) $item['perfume']->current_price * $item['quantity']);
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ROSEE-'.strtoupper(Str::random(8)),
                'total' => $total,
                'status' => 'pending_payment',
                'payment_reference' => 'PAY-'.strtoupper(Str::random(10)),
            ]);

            foreach ($items as $item) {
                $perfume = $item['perfume'];
                OrderItem::create([
                    'order_id' => $order->id,
                    'perfume_id' => $perfume->id,
                    'name' => $perfume->name,
                    'quantity' => $item['quantity'],
                    'unit_price' => $perfume->current_price,
                ]);
                $perfume->decrement('stock', $item['quantity']);
            }

            return $order;
        });

        $request->session()->forget('cart');

        return redirect()->route('order.payment', $order);
    }

    public function payment(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('storefront.payment', ['order' => $order->load('items')]);
    }

    public function confirmPayment(Order $order): RedirectResponse
    {
        abort_unless($order->user_id === auth()->id(), 403);
        $order->update(['status' => 'paid', 'paid_at' => now()]);

        return redirect()->route('order.thank-you', $order);
    }

    public function thankYou(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return view('storefront.thank-you', ['order' => $order->load('items')]);
    }
}
