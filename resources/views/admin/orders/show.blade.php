@extends('layouts.admin')
@section('title', 'Order '.$order->order_number)

@php
    $isAdmin = auth()->user()->isAdmin();
    $indexRoute = $isAdmin ? 'admin.orders.index' : 'staff.orders.index';
    $statusRoute = $isAdmin ? 'admin.orders.status' : 'staff.orders.status';
@endphp

@section('content')
<a href="{{ route($indexRoute) }}" class="small text-muted-rose"><i class="bi bi-arrow-left me-1"></i>Back to orders</a>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 my-3">
    <div>
        <h3 class="font-display mb-0">{{ $order->order_number }}</h3>
        <small class="text-muted-rose">{{ $order->created_at->format('d M Y, H:i') }} · by {{ $order->user->name ?? 'Guest' }}</small>
    </div>
    <form method="POST" action="{{ route($statusRoute, $order) }}" class="d-flex gap-2 align-items-center">
        @csrf @method('PATCH')
        <span class="status-pill status-{{ $order->status }}">{{ $order->status }}</span>
        <select name="status" class="form-select form-select-sm" style="width:auto;">
            @foreach(App\Models\Order::STATUSES as $status)
                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        <button class="btn btn-rose btn-sm-round btn-sm">Update</button>
    </form>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card card-soft p-4">
            <h5 class="font-display mb-3">Items</h5>
            @foreach($order->items as $item)
                <div class="d-flex justify-content-between py-2 border-bottom">
                    <div>
                        <div class="fw-semibold">{{ $item->perfume_name }}</div>
                        <small class="text-muted-rose">${{ number_format($item->unit_price, 2) }} × {{ $item->quantity }}</small>
                    </div>
                    <div class="fw-semibold">${{ number_format($item->subtotal, 2) }}</div>
                </div>
            @endforeach
            <div class="d-flex justify-content-between small mt-3 text-muted-rose">
                <span>Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between small text-muted-rose">
                <span>Shipping</span><span>{{ $order->shipping_fee == 0 ? 'FREE' : '$'.number_format($order->shipping_fee, 2) }}</span>
            </div>
            <div class="d-flex justify-content-between fw-semibold fs-5 mt-2">
                <span>Total</span><span class="text-rose">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card card-soft p-4 mb-3">
            <h5 class="font-display mb-3">Customer</h5>
            <p class="mb-1 fw-semibold">{{ $order->customer_name }}</p>
            <p class="mb-1 small text-muted-rose"><i class="bi bi-telephone me-1"></i>{{ $order->phone }}</p>
            <p class="mb-0 small text-muted-rose"><i class="bi bi-geo-alt me-1"></i>{{ $order->address }}, {{ $order->city }}</p>
            @if($order->notes)
                <p class="mb-0 small text-muted-rose mt-2"><i class="bi bi-chat-left-heart me-1"></i>{{ $order->notes }}</p>
            @endif
        </div>
        <div class="card card-soft p-4">
            <h5 class="font-display mb-3">Payment</h5>
            <p class="mb-1 small">Method: <span class="text-uppercase fw-semibold">{{ str_replace('_', ' ', $order->payment_method) }}</span></p>
            <p class="mb-0 small">Status:
                <span class="status-pill {{ $order->payment_status === 'paid' ? 'status-delivered' : 'status-pending' }}">{{ $order->payment_status }}</span>
            </p>
        </div>
    </div>
</div>
@endsection