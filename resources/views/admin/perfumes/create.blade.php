@extends('layouts.admin')
@section('title', 'Add Perfume')

@section('content')
<h3 class="font-display mb-4">Add perfume</h3>
<div class="card card-soft p-4" style="max-width:720px;">
    <form method="POST" action="{{ route('admin.perfumes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Brand</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand', 'Flowers') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">For</label>
                <select name="audience" class="form-select" required><option value="unisex">Both / Unisex</option><option value="women" {{ old('audience') === 'women' ? 'selected' : '' }}>Women</option><option value="men" {{ old('audience') === 'men' ? 'selected' : '' }}>Men</option></select>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">Choose…</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Size</label>
                <input type="text" name="size" class="form-control" value="{{ old('size', '50ml') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" min="0" required>
                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" min="0" required>
                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Sale price ($) <span class="text-muted-rose">(optional)</span></label>
                <input type="number" step="0.01" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price') }}" min="0">
                @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <small class="text-muted-rose">JPG/PNG up to 2MB. If empty, a pretty placeholder is used.</small>
        </div>
        <div class="d-flex gap-4 mb-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featured">
                <label class="form-check-label" for="featured">Featured on homepage</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active" checked>
                <label class="form-check-label" for="active">Visible in shop</label>
            </div>
        </div>
        <button class="btn btn-rose">Add perfume</button>
        <a href="{{ route('admin.perfumes.index') }}" class="btn btn-outline-rose">Cancel</a>
    </form>
</div>
@endsection