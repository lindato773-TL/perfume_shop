@extends('layouts.guest')
@section('title', 'Order review · Flowers')
@section('content')
    <section class="page-intro page-intro-small">
        <div class="container"><span class="eyebrow">Almost yours</span>
            <h1 class="display-3">Review your order</h1>
            <p class="lead text-muted-rose">Place your order, then scan the QR code to complete payment.</p>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="summary-card"><span class="eyebrow">Your selection</span>
                        @forelse(session('cart', []) as $id => $quantity)
                            @php $perfume = App\Models\Perfume::find($id) @endphp @if ($perfume)
                                <div class="bag-item"><img src="{{ $perfume->image_url }}" alt="{{ $perfume->name }}">
                                    <div class="flex-grow-1">
                                        <h2 class="h4 mb-1">{{ $perfume->name }}</h2><span
                                            class="text-muted-rose">{{ $quantity }} ×
                                            ${{ number_format($perfume->current_price, 2) }}</span>
                                    </div>
                                    <strong>${{ number_format((float) $perfume->current_price * $quantity, 2) }}</strong>
                                </div>
                            @endif @empty<p class="text-muted-rose mt-3">Your bag is empty.</p>
                        @endforelse
                    </div>
                </div>
                <aside class="col-lg-5">
                    <div class="summary-card"><span class="eyebrow">Confirm order</span>
                        <p class="text-muted-rose mt-3">You are ordering as <strong>{{ auth()->user()->email }}</strong>.
                        </p>
                        <div class="d-flex justify-content-between border-top pt-3 mt-4">
                            <span>Total</span><strong>Calculated from your bag</strong>
                        </div>
                        <form method="POST" action="{{ route('checkout.place') }}" class="mt-4">@csrf<button
                                class="btn btn-rose w-100 btn-sm-round py-3" type="submit">Place order and show QR <i
                                    class="bi bi-qr-code ms-2"></i></button></form><a
                            class="d-block text-center text-muted-rose mt-3" href="{{ route('cart') }}">Back to bag</a>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
