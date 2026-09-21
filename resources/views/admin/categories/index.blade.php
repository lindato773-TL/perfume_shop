@extends('layouts.admin')
@section('title', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-display mb-0">Categories</h3>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-rose btn-sm-round"><i class="bi bi-plus-lg me-1"></i>New category</a>
</div>

<div class="card card-soft">
    <table class="table align-middle mb-0">
        <thead><tr><th>Name</th><th>Description</th><th>Perfumes</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td class="fw-semibold">{{ $category->name }}</td>
                <td class="text-muted-rose">{{ $category->description ?? '—' }}</td>
                <td><span class="badge-soft">{{ $category->perfumes_count }}</span></td>
                <td>
                    @if($category->is_active)
                        <span class="status-pill status-delivered">Active</span>
                    @else
                        <span class="status-pill status-cancelled">Hidden</span>
                    @endif
                </td>
                <td class="text-end">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-rose btn-sm-round">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline"
                          onsubmit="return confirm('Delete category {{ $category->name }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-sm-round btn-outline-danger"><i class="bi bi-trash3"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3">{{ $categories->links() }}</div>
@endsection