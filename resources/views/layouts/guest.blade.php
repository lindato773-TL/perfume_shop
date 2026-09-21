<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Flowers')</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-expand-lg storefront-nav">
		<div class="container py-3">
			<a class="brand-logo" href="{{ route('home') }}">Flowers</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#storefrontMenu" aria-label="Toggle navigation"><i class="bi bi-list"></i></button>
			<div class="collapse navbar-collapse" id="storefrontMenu">
				<div class="navbar-nav mx-auto gap-lg-4">
					<a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
					<a class="nav-link {{ request()->routeIs('collection') ? 'active' : '' }}" href="{{ route('collection') }}">Collection</a>
					<a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About us</a>
				</div>
				<div class="d-flex align-items-center gap-3 nav-actions">
					@auth
						@if(auth()->user()->isStaff())<a class="nav-link" href="{{ route('admin.dashboard') }}">Studio</a>@endif
						<form method="POST" action="{{ route('logout') }}"><button type="submit" class="nav-link p-0">Sign out</button>@csrf</form>
					@else
						<a class="nav-link" href="{{ route('login') }}">Log in</a>
						<a class="btn btn-rose btn-sm-round px-3" href="{{ route('register') }}">Register</a>
					@endauth
					<a class="cart-link" href="{{ route('cart') }}" aria-label="Shopping bag"><i class="bi bi-bag"></i><span>{{ collect(session('cart', []))->sum() }}</span></a>
				</div>
			</div>
		</div>
	</nav>
	@if(session('success'))<div class="container pt-3"><div class="store-alert"><i class="bi bi-check2"></i>{{ session('success') }}</div></div>@endif
	@if(session('error'))<div class="container pt-3"><div class="store-alert store-alert-error"><i class="bi bi-exclamation-circle"></i>{{ session('error') }}</div></div>@endif
	@yield('content')
	<footer class="site-footer"><div class="container d-flex flex-wrap justify-content-between align-items-center gap-3"><a class="brand-logo" href="{{ route('home') }}">Flowers</a><span>Quietly unforgettable fragrance.</span><span>© {{ date('Y') }} Flowers</span></div></footer>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
