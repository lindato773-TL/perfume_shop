@extends('layouts.admin')
@section('title', 'New User')

@section('content')
<h3 class="font-display mb-4">New user</h3>
<div class="card card-soft p-4" style="max-width:640px;">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Full name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="customer">Customer</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone <span class="text-muted-rose">(optional)</span></label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label">Address <span class="text-muted-rose">(optional)</span></label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>
        <button class="btn btn-rose"><i class="bi bi-check-lg me-1"></i>Create user</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-rose">Cancel</a>
    </form>
</div>
@endsection