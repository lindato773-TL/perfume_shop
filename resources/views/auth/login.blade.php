@extends('layouts.guest')
@section('title', 'Log in · Flower')
@section('content')<main class="auth-shell">
        <div class="auth-card"><a class="brand-logo d-block text-center mb-4" href="{{ route('home') }}">Flowers</a>
            <h1 class="font-display text-center h2">Welcome back</h1>
            <p class="text-muted-rose text-center mb-4">Step into your fragrance studio.</p>
            <form method="POST" action="{{ route('login.store') }}">@csrf<div class="mb-3"><label class="form-label">Email
                        address</label><input class="form-control @error('email') is-invalid @enderror" type="email"
                        name="email" value="{{ old('email') }}" required autofocus>
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
                <div class="form-check mb-4"><input class="form-check-input" type="checkbox" name="remember"
                        id="remember"><label class="form-check-label text-muted-rose" for="remember">Remember me</label>
                </div><button type="submit" class="btn btn-rose w-100 py-2">Log in</button>
            </form>
            <p class="text-center text-muted-rose mt-4 mb-0">New here? <a class="text-rose"
                    href="{{ route('register') }}">Create an account</a></p>
        </div>
</main>@endsection
