@extends('layouts.guest')
@section('title', 'Your bag · Flowers')
@section('content')
    <section class="bg-light border-bottom py-5">
        <div class="container"><span class="text-uppercase text-secondary small fw-semibold">Your ritual</span>
            <h1 class="display-3 mb-0">Your bag</h1>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            @if ($items->isEmpty())
                <div class="text-center py-5"><i class="bi bi-bag-heart display-4 text-secondary"></i>
                    <h2 class="display-6 mt-3">Your bag is waiting.</h2>
                    <p class="text-secondary">Find a composition to take home and make it yours.</p><a
                        class="btn btn-dark px-4" href="{{ route('collection') }}">Browse collection</a>
                </div>
            @else
                <div class="row g-5">
                    <div class="col-lg-8">
                        <form method="POST" action="{{ route('cart.update') }}">@csrf @method('PATCH')
                            @foreach ($items as $item)
                                <div class="card border-0 shadow-sm rounded-4 mb-3">
                                    <div class="card-body">
                                        <div class="row align-items-center g-3">
                                            <div class="col-3 col-md-2"><img src="{{ $item['perfume']->image_url }}"
                                                    class="img-fluid rounded-3 object-fit-cover"
                                                    style="height: 96px; width: 100%;" alt="{{ $item['perfume']->name }}">
                                            </div>
                                            <div class="col-9 col-md-4"><small
                                                    class="text-uppercase text-secondary">{{ $item['perfume']->category->name ?? 'Flowers' }}</small>
                                                <h2 class="h4 mb-1">{{ $item['perfume']->name }}</h2><span
                                                    class="text-secondary">{{ $item['perfume']->size }} ·
                                                    ${{ number_format($item['perfume']->current_price, 2) }}</span>
                                            </div>
                                            <div class="col-6 col-md-3"><label class="form-label small text-secondary mb-1"
                                                    for="quantity-{{ $item['perfume']->id }}">Quantity</label><input
                                                    id="quantity-{{ $item['perfume']->id }}" class="form-control"
                                                    type="number" min="0" max="{{ $item['perfume']->stock }}"
                                                    name="quantities[{{ $item['perfume']->id }}]"
                                                    value="{{ $item['quantity'] }}"></div>
                                            <div class="col-4 col-md-2 text-md-end">
                                                <strong>${{ number_format($item['subtotal'], 2) }}</strong></div>
                                            <div class="col-2 col-md-1 text-end"><button
                                                    class="btn btn-link text-danger p-0" type="submit"
                                                    form="remove-{{ $item['perfume']->id }}"
                                                    aria-label="Remove {{ $item['perfume']->name }}"><i
                                                        class="bi bi-trash3"></i></button></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    </div>
                    <aside class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4"><span
                                    class="text-uppercase text-secondary small fw-semibold">Summary</span>
                                <div class="d-flex justify-content-between mt-4">
                                    <span>Subtotal</span><strong>${{ number_format($subtotal, 2) }}</strong></div>
                                <div class="d-flex justify-content-between text-secondary mt-2"><span>Payment</span><span>QR
                                        payment</span></div>
                                <hr><a class="btn btn-dark w-100 py-3" href="{{ route('checkout') }}">Order now <i
                                        class="bi bi-arrow-right ms-2"></i></a>
                                <p class="small text-secondary mt-3 mb-0">Review your items and pay by QR.</p>
                            </div>
                        </div>
                    </aside>
                </div>
                @foreach ($items as $item)
                    <form id="remove-{{ $item['perfume']->id }}" method="POST"
                        action="{{ route('cart.remove', $item['perfume']) }}">@csrf @method('DELETE')</form>
                @endforeach
            @endif
        </div>
    </section>
@endsection
