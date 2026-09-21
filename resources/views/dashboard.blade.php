@extends('layouts.guest')
@section('title', 'Flowers · Quietly unforgettable')
@section('content')
    <section class="hero">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-lg-6 hero-copy"><span class="eyebrow">The house of Flowers smell</span>
                    <h1 class="display-1 fw-semibold mt-3">Scent, with a softer point of view.</h1>
                    {{-- <p class="lead text-muted-rose my-4">A considered collection of modern fragrances, composed for the
                        moments that stay with you.</p>
                        <a href="{{ route('collection') }}"
                        class="btn btn-rose btn-lg btn-sm-round px-4">Explore the collection <i
                            class="bi bi-arrow-up-right ms-2"></i></a> --}}
                    <div class="mt-5"> Composed for the everyday extraordinary</div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://i.pinimg.com/1200x/64/46/c8/6446c84e77db7fbc17cde153a40507b8.jpg"
                        class="img-fluid rounded-circle" style="width: 500px; height: 500px; object-fit: cover;"
                        alt="">
                </div>
            </div>
        </div>
        </div>
    </section>
    <section id="collection" class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div><span class="eyebrow">A little ritual</span>
                    <h2 class="display-5 mb-0">Find your signature</h2>
                </div><a class="text-rose" href="{{ route('collection') }}">View all <i
                        class="bi bi-arrow-up-right"></i></a>
            </div>
            <div class="row g-4">
                @forelse($featured as $perfume)
                    <div class="col-md-4">
                        <article class="card product-card border-0">
                            <div class="product-image-wrap"><img src="{{ $perfume->image_url }}" class="card-img-top"
                                    alt="{{ $perfume->name }}"><span
                                    class="product-tag">{{ $perfume->is_featured ? 'Bestseller' : 'New' }}</span></div>
                            <div class="card-body p-4"><small class="eyebrow">{{ $perfume->category->name }}</small>
                                <h3 class="h3 mt-2">{{ $perfume->name }}</h3>
                                <p class="text-muted-rose">{{ Str::limit($perfume->description, 90) }}</p>
                                <div class="d-flex justify-content-between align-items-center"><span
                                        class="fw-semibold">${{ number_format($perfume->current_price, 2) }}</span>
                                    <form method="POST" action="{{ route('cart.add', $perfume) }}">@csrf<button
                                            type="submit" class="btn btn-outline-rose btn-sm-round"
                                            aria-label="Add {{ $perfume->name }} to bag"><i
                                                class="bi bi-bag-plus me-1"></i>Select this scent</button></form>
                                </div>
                            </div>
                        </article>
                </div>@empty<div class="col-12">
                        <div class="card-soft p-5 text-center">Your first collection is being composed.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="story-band">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5"><span class="eyebrow">Our philosophy</span>
                    <h2 class="display-5">Made to be remembered, never to overwhelm.</h2>
                </div>
                <div class="col-lg-6 ms-auto">
                    <p class="lead text-muted-rose">Flowers is a study in balance: luminous ingredients, gentle textures,
                        and
                        a little room for your own story.</p><a class="text-rose" href="{{ route('about') }}">Meet the
                        house <i class="bi bi-arrow-up-right"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
