@extends('layouts.admin')
@section('title', 'Staff Dashboard')

@section('content')
    <h3 class="font-display mb-1">Hello, {{ auth()->user()->name }} ✨</h3>
    <small class="text-muted-rose d-block mb-4">Keep the boutique running smoothly today.</small>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="icon-circle bg-gold-soft"><i class="bi bi-droplet-half"></i></div>
                <div>
                    <h4 class="font-display mb-0">{{ $stats['products'] }}</h4><small class="text-muted-rose">Products</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="icon-circle bg-blue-soft"><i class="bi bi-hourglass-split"></i></div>
                <div>
                    <h4 class="font-display mb-0">{{ $stats['pendingOrders'] }}</h4><small class="text-muted-rose">Pending
                        orders</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="icon-circle bg-rose-soft"><i class="bi bi-exclamation-diamond"></i></div>
                <div>
                    <h4 class="font-display mb-0">{{ $stats['lowStockCount'] }}</h4><small class="text-muted-rose">Low stock
                        items</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card card-soft p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="font-display mb-0">Recent orders</h5>
                    <a href="{{ route('staff.orders.index') }}" class="small">View all</a>
                </div>
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td class="fw-semibold">{{ $order->order_number }}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td><span class="status-pill status-{{ $order->status }}">{{ $order->status }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted-rose py-4">No orders yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-soft p-4">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="font-display mb-0">Restock needed</h5>
                    <a href="{{ route('staff.perfumes.index') }}" class="small">Manage stock</a>
                </div>
                @forelse($lowStock as $perfume)
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span>{{ $perfume->name }}</span>
                        <span class="status-pill status-cancelled">{{ $perfume->stock }} left</span>
                    </div>
                @empty
                    <p class="text-muted-rose mb-0">Everything is well stocked. 🎉</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
