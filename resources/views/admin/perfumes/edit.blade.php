@extends('layouts.admin')
@section('title', 'Edit Perfume')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><span class="text-uppercase text-secondary small fw-semibold">Perfume studio</span><h3 class="h2 mb-0">Edit perfume</h3></div>
    <a href="{{ route('admin.perfumes.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<div class="card border-0 shadow-sm rounded-4 p-4" style="max-width: 820px;">
    <form method="POST" action="{{ route('admin.perfumes.update', $perfume) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $perfume->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Brand</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand', $perfume->brand) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">For</label>
                <select name="audience" class="form-select" required><option value="unisex" {{ old('audience', $perfume->audience) === 'unisex' ? 'selected' : '' }}>Both / Unisex</option><option value="women" {{ old('audience', $perfume->audience) === 'women' ? 'selected' : '' }}>Women</option><option value="men" {{ old('audience', $perfume->audience) === 'men' ? 'selected' : '' }}>Men</option></select>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $perfume->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Size</label>
                <input type="text" name="size" class="form-control" value="{{ old('size', $perfume->size) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $perfume->stock) }}" min="0" required>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Price ($)</label>
                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $perfume->price) }}" min="0" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sale price ($)</label>
                <input type="number" step="0.01" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror"
                       value="{{ old('sale_price', $perfume->sale_price) }}" min="0">
                @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $perfume->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="perfume-image" class="form-label fw-semibold">Perfume image</label>
            <div class="row g-3 align-items-center">
                <div class="col-sm-4">
                    <img id="image-preview" src="{{ $perfume->image_url }}" class="img-fluid rounded-4 border object-fit-cover" style="height: 180px; width: 100%;" alt="Preview of {{ $perfume->name }}">
                </div>
                <div class="col-sm-8">
                    <input id="perfume-image" type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/webp">
                    <div class="form-text">Choose a JPG, PNG, or WebP image up to 2MB. The shop and cart will use it after saving.</div>
                </div>
            </div>
            @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="d-flex gap-4 mb-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featured"
                       {{ old('is_featured', $perfume->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="featured">Featured on homepage</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active"
                       {{ old('is_active', $perfume->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Visible in shop</label>
            </div>
        </div>
        <button class="btn btn-dark px-4"><i class="bi bi-check2 me-1"></i>Save changes</button>
        <a href="{{ route('admin.perfumes.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<script>
    document.querySelector('#perfume-image')?.addEventListener('change', (event) => {
        const file = event.target.files?.[0];
        if (file) document.querySelector('#image-preview').src = URL.createObjectURL(file);
    });
</script>
@endsection