@extends('layouts.admin')
@section('title', 'Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><span class="eyebrow">Order processing</span><h3 class="font-display mb-0">Customer orders</h3></div>
    <span class="text-muted-rose">{{ $orders->total() }} total</span>
</div>

<div class="d-flex gap-2 flex-wrap mb-4">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-sm-round {{ request('status') ? 'btn-outline-rose' : 'btn-rose' }}">All</a>
    @foreach($statuses as $status)
        <a href="{{ route('admin.orders.index', ['status' => $status]) }}" class="btn btn-sm btn-sm-round {{ request('status') === $status ? 'btn-rose' : 'btn-outline-rose' }}">{{ ucwords(str_replace('_', ' ', $status)) }}</a>
    @endforeach
</div>

<div class="card card-soft">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>Order</th><th>Customer</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th></th></tr></thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td class="fw-semibold">{{ $order->order_number }}<small class="d-block text-muted-rose">{{ $order->payment_reference }}</small></td>
                    <td>{{ $order->user->name ?? 'Member' }}<small class="d-block text-muted-rose">{{ $order->user->email ?? '' }}</small></td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $order->items_count }}</td>
                    <td class="fw-semibold">${{ number_format($order->total, 2) }}</td>
                    <td><span class="status-pill status-{{ $order->status }}">{{ ucwords(str_replace('_', ' ', $order->status)) }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="d-flex gap-2">
                            @csrf @method('PATCH')
                            <select name="status" class="form-select form-select-sm" aria-label="Status for {{ $order->order_number }}">
                                @foreach($statuses as $status)<option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $status)) }}</option>@endforeach
                            </select>
                            <button class="btn btn-sm btn-rose btn-sm-round" type="submit" aria-label="Save status"><i class="bi bi-check2"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center text-muted-rose py-5">No orders found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orders->links() }}</div>
@endsection