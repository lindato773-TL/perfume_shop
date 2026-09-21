@extends('layouts.admin')
@section('title', 'Edit User')

@section('content')
<h3 class="font-display mb-4">Edit user · {{ $user->name }}</h3>
<div class="card card-soft p-4" style="max-width:640px;">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Full name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">New password <span class="text-muted-rose">(leave empty to keep)</span></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                    @foreach(['customer','staff','admin'] as $role)
                        <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                @if($user->id === auth()->id())<small class="text-muted-rose">You cannot change your own role.</small>@endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
        </div>
        <button class="btn btn-rose"><i class="bi bi-check-lg me-1"></i>Save changes</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-rose">Cancel</a>
    </form>
</div>
@endsection