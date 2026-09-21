<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::with('user')->withCount('items')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest()->paginate(15)->withQueryString();

        return view('admin.orders.index', ['orders' => $orders, 'statuses' => Order::STATUSES]);
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate(['status' => ['required', 'in:'.implode(',', Order::STATUSES)]]);
        $order->update([
            'status' => $data['status'],
            'paid_at' => $data['status'] === 'paid' ? ($order->paid_at ?? now()) : $order->paid_at,
        ]);

        return back()->with('success', 'Order status updated.');
    }
}