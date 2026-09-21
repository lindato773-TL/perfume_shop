@extends('layouts.guest')
@section('title', 'Register · Flower')
@section('content')<main class="auth-shell">
        <div class="auth-card"><a class="brand-logo d-block text-center mb-4" href="{{ route('home') }}">Flowers</a>
            <h1 class="font-display text-center h2">Make it yours</h1>
            <p class="text-muted-rose text-center mb-4">Save your edit and return to it whenever inspiration calls.</p>
            <form method="POST" action="{{ route('register.store') }}">@csrf<div class="mb-3"><label class="form-label">Full
                        name</label><input class="form-control @error('name') is-invalid @enderror" type="text"
                        name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3"><label class="form-label">Email address</label><input
                        class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                        value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3"><label class="form-label">Password</label><input
                        class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4"><label class="form-label">Confirm password</label><input class="form-control"
                        type="password" name="password_confirmation" required></div><button type="submit"
                    class="btn btn-rose w-100 py-2">Create account</button>
            </form>
            <p class="text-center text-muted-rose mt-4 mb-0">Already a member? <a class="text-rose"
                    href="{{ route('login') }}">Sign in</a></p>
        </div>
</main>@endsection
