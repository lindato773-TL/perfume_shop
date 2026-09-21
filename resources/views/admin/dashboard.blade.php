@extends('layouts.admin')
@section('title', 'Studio dashboard')
@section('content')
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div><span class="eyebrow">Flower
             studio</span>
            <h1 class="font-display mb-0">Good morning, {{ auth()->user()->name }}</h1>
            <p class="text-muted-rose mb-0">A clear view of your collection.</p>
        </div><a href="{{ route('admin.perfumes.create') }}" class="btn btn-rose btn-sm-round"><i
                class="bi bi-plus-lg me-1"></i>New perfume</a>
    </div>
    <div class="row g-3 mb-4">
        @foreach ([['users', 'Members', 'people'], ['perfumes', 'Perfumes', 'droplet-half'], ['categories', 'Categories', 'layers'], ['lowStock', 'Low stock', 'exclamation-diamond'], ['soldOut', 'Sold out', 'slash-circle']] as [$key, $label, $icon])
            <div class="col-sm-6 col-xl-3">
                <div class="stat-card d-flex align-items-center gap-3">
                    <div class="icon-circle bg-rose-soft"><i class="bi bi-{{ $icon }}"></i></div>
                    <div>
                        <h2 class="font-display mb-0">{{ $stats[$key] }}</h2><small
                            class="text-muted-rose">{{ $label }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="card card-soft">
        <div class="p-4 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="font-display h4 mb-1">Latest compositions</h2>
                <p class="text-muted-rose mb-0">Your newest additions to the house.</p>
            </div><a href="{{ route('admin.perfumes.index') }}" class="text-rose">View all <i
                    class="bi bi-arrow-right"></i></a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Perfume</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestPerfumes as $perfume)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3"><img src="{{ $perfume->image_url }}"
                                        class="table-img" alt=""><span
                                        class="fw-semibold">{{ $perfume->name }}</span></div>
                            </td>
                            <td>{{ $perfume->category->name }}</td>
                            <td>${{ number_format($perfume->current_price, 2) }}</td>
                                <td>@if($perfume->stock === 0)<span class="status-pill status-cancelled">Sold out</span>@elseif($perfume->stock <= 5)<span class="status-pill status-pending">{{ $perfume->stock }} left</span>@else<span class="status-pill status-delivered">{{ $perfume->stock }} in stock</span>@endif</td>
                            <td class="text-end"><a href="{{ route('admin.perfumes.edit', $perfume) }}"
                                    class="btn btn-sm btn-outline-rose btn-sm-round"><i class="bi bi-pencil"></i></a></td>
                    </tr>@empty<tr>
                            <td colspan="5" class="text-center text-muted-rose py-5">No perfumes yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
