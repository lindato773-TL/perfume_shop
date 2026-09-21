@extends('layouts.guest')
@section('title', 'Collection · Flowers')
@section('content')
<section class="page-intro"><div class="container"><span class="eyebrow">The edit</span><h1 class="display-3">The Flowers collection</h1><p class="lead text-muted-rose">Find the scent that feels like you.</p></div></section>
<section class="py-5"><div class="container"><div class="collection-toolbar"><div class="filter-pills" role="group" aria-label="Filter by audience"><button type="button" class="filter-pill {{ $activeAudience === '' ? 'active' : '' }}" data-audience-filter="">All</button><button type="button" class="filter-pill {{ $activeAudience === 'women' ? 'active' : '' }}" data-audience-filter="women">Women</button><button type="button" class="filter-pill {{ $activeAudience === 'men' ? 'active' : '' }}" data-audience-filter="men">Men</button><button type="button" class="filter-pill {{ $activeAudience === 'unisex' ? 'active' : '' }}" data-audience-filter="unisex">Unisex</button></div><span class="text-muted-rose" id="collection-count">{{ $perfumes->count() }} compositions</span></div><div class="row g-4" id="collection-grid">
@forelse($perfumes as $perfume)
<div class="col-sm-6 col-lg-4 collection-item" data-audience="{{ $perfume->audience }}"><article class="card product-card border-0"><div class="product-image-wrap"><img src="{{ $perfume->image_url }}" class="card-img-top" alt="{{ $perfume->name }}"><span class="product-tag">{{ ucfirst($perfume->audience) }}</span></div><div class="card-body p-4"><small class="eyebrow">{{ $perfume->category->name ?? 'Rosée' }}</small><h2 class="h3 mt-2">{{ $perfume->name }}</h2><p class="text-muted-rose">{{ Str::limit($perfume->description, 95) }}</p><div class="d-flex justify-content-between align-items-center"><div><span class="fw-semibold">${{ number_format($perfume->current_price, 2) }}</span><span class="text-muted-rose ms-2">{{ $perfume->size }}</span></div>@if($perfume->stock > 0)<form method="POST" action="{{ route('cart.add', $perfume) }}">@csrf<button type="submit" class="btn btn-outline-rose btn-sm-round" aria-label="Add {{ $perfume->name }} to bag"><i class="bi bi-bag-plus me-1"></i>Add</button></form>@else<span class="status-pill status-cancelled">Sold out</span>@endif</div></div></article></div>
@empty
<div class="col-12"><div class="card-soft p-5 text-center">No compositions found in this edit.</div></div>
@endforelse
</div><div class="col-12 d-none" id="collection-empty"><div class="card-soft p-5 text-center">No compositions found in this edit.</div></div></div></div></section>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const buttons = [...document.querySelectorAll('[data-audience-filter]')];
		const items = [...document.querySelectorAll('.collection-item')];
		const count = document.querySelector('#collection-count');
		const empty = document.querySelector('#collection-empty');

		const applyFilter = (audience, updateUrl = true) => {
			let visible = 0;
			items.forEach((item) => {
				const matches = !audience || item.dataset.audience === audience;
				item.classList.toggle('d-none', !matches);
				if (matches) visible += 1;
			});
			buttons.forEach((button) => button.classList.toggle('active', button.dataset.audienceFilter === audience));
			count.textContent = `${visible} composition${visible === 1 ? '' : 's'}`;
			empty.classList.toggle('d-none', visible !== 0);
			if (updateUrl) {
				const url = new URL(window.location.href);
				audience ? url.searchParams.set('audience', audience) : url.searchParams.delete('audience');
				window.history.replaceState({}, '', url);
			}
		};

		buttons.forEach((button) => button.addEventListener('click', () => applyFilter(button.dataset.audienceFilter)));
		applyFilter(@json($activeAudience), false);
	});
</script>
@endsection
