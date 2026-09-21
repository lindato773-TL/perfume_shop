@extends('layouts.admin')
@section('title', 'Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div><span class="eyebrow">Customer directory</span><h3 class="font-display mb-0">Members</h3></div>
    <span class="text-muted-rose">{{ $users->total() }} registered</span>
</div>

<div class="card card-soft">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Phone</th><th>Orders</th><th>Joined</th></tr></thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="role-pill role-{{ $user->role }}">{{ $user->role }}</span></td>
                    <td>{{ $user->orders_count }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $users->links() }}</div>
@endsection