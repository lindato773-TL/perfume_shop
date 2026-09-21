@extends('layouts.admin')
@section('title', 'Perfumes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="font-display mb-0">Perfumes</h3>
    <a href="{{ route('admin.perfumes.create') }}" class="btn btn-rose btn-sm-round"><i class="bi bi-plus-lg me-1"></i>Add perfume</a>
</div>

<div class="card card-soft">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Flags</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @foreach($perfumes as $perfume)
                <tr>
                    <td><img src="{{ $perfume->image_url }}" class="table-img" alt=""></td>
                    <td>
                        <div class="fw-semibold">{{ $perfume->name }}</div>
                        <small class="text-muted-rose">{{ $perfume->brand }} · {{ $perfume->size }}</small>
                    </td>
                    <td>{{ $perfume->category->name ?? '—' }}</td>
                    <td>
                        @if($perfume->sale_price)
                            <span class="price-old d-block">${{ number_format($perfume->price, 2) }}</span>
                            <span class="text-rose fw-semibold">${{ number_format($perfume->sale_price, 2) }}</span>
                        @else
                            ${{ number_format($perfume->price, 2) }}
                        @endif
                    </td>
                    <td>
                        @if($perfume->stock === 0)
                            <span class="status-pill status-cancelled">Sold out</span>
                        @elseif($perfume->stock <= 5)
                            <span class="status-pill status-pending">{{ $perfume->stock }} left</span>
                        @else
                            <span class="status-pill status-delivered">{{ $perfume->stock }}</span>
                        @endif
                    </td>
                    <td class="small">
                        @if($perfume->is_featured)<span class="badge-soft me-1">Featured</span>@endif
                        @if($perfume->is_active)<span class="status-pill status-delivered">Active</span>
                        @else<span class="status-pill status-cancelled">Hidden</span>@endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.perfumes.edit', $perfume) }}" class="btn btn-sm btn-outline-rose btn-sm-round">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('admin.perfumes.destroy', $perfume) }}" class="d-inline"
                              onsubmit="return confirm('Delete {{ $perfume->name }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-sm-round btn-outline-danger"><i class="bi bi-trash3"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $perfumes->links() }}</div>
@endsection