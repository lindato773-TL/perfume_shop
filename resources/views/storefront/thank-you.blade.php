@extends('layouts.guest')
@section('title', 'Thank you · Flowers')
@section('content')
    <section class="thank-you">
        <div class="container text-center">
            <div class="welcome-mark"><i class="bi bi-check2"></i></div><span class="eyebrow">Thank you for choosing
                Flowers</span>
            <h1 class="display-2 mt-3">Your order is confirmed.</h1>
            <p class="lead text-muted-rose mx-auto">We received your payment confirmation and are preparing your selection
                with care.</p>
            <div class="receipt-card text-start mx-auto">
                <div class="d-flex justify-content-between"><span>Order</span><strong>{{ $order->order_number }}</strong>
                </div>
                <div class="d-flex justify-content-between mt-2"><span>Status</span><span
                        class="status-pill status-delivered">Payment received</span></div>
                <hr>
                @foreach ($order->items as $item)
                    <div class="d-flex justify-content-between small py-1"><span>{{ $item->name }} ×
                            {{ $item->quantity }}</span><span>${{ number_format((float) $item->unit_price * $item->quantity, 2) }}</span>
                    </div>
                @endforeach
                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total</strong><strong>${{ number_format($order->total, 2) }}</strong></div>
            </div><a class="btn btn-rose btn-sm-round px-4 mt-4" href="{{ route('collection') }}">Continue browsing</a>
        </div>
    </section>
    <script>
        window.addEventListener('load', () => {
            const message = document.createElement('div');
            message.className = 'thank-you-toast';
            message.innerHTML = '<i class="bi bi-heart-fill"></i> Thank you. Your payment was received.';
            document.body.append(message);
            setTimeout(() => message.classList.add('show'), 150);
            setTimeout(() => message.classList.remove('show'), 4200);
        });
    </script>
@endsection
