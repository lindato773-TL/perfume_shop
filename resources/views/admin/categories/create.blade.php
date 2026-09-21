@extends('layouts.admin')
@section('title', 'New Category')

@section('content')
<h3 class="font-display mb-4">New category</h3>
<div class="card card-soft p-4" style="max-width:560px;">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description <span class="text-muted-rose">(optional)</span></label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active" checked>
            <label class="form-check-label" for="active">Visible in shop</label>
        </div>
        <button class="btn btn-rose">Create category</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-rose">Cancel</a>
    </form>
</div>
@endsection