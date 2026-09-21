<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') · Flowers Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
@php $isAdmin = auth()->user()->isAdmin(); @endphp
<div class="admin-shell min-vh-100">
    <div class="row">
        <aside class="col-lg-2 col-md-3 px-0">
            <div class="sidebar bg-white border-end min-vh-100 p-3">
                <a href="{{ route('home') }}" class="brand-logo d-block mb-4">
                    <i class="bi bi-flower1"></i> Flowers
                </a>
                <small class="sidebar-label text-muted-rose text-uppercase d-block mb-2">
                    {{ $isAdmin ? 'Administration' : 'Staff area' }}
                </small>
                <ul class="nav flex-column">
                    <li><a class="nav-link {{ request()->routeIs('admin.dashboard','staff.dashboard') ? 'active' : '' }}"
                           href="{{ route($isAdmin ? 'admin.dashboard' : 'staff.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                    @if($isAdmin)
                        <li><a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                               href="{{ route('admin.users.index') }}">
                            <i class="bi bi-people me-2"></i>Members</a></li>
                        <li><a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                               href="{{ route('admin.orders.index') }}">
                            <i class="bi bi-receipt me-2"></i>Orders</a></li>
                        <li><a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                               href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-grid me-2"></i>Categories</a></li>
                        <li><a class="nav-link {{ request()->routeIs('admin.perfumes.*') ? 'active' : '' }}"
                               href="{{ route('admin.perfumes.index') }}">
                            <i class="bi bi-droplet-half me-2"></i>Perfumes</a></li>
                    @else
                        <li><a class="nav-link {{ request()->routeIs('staff.perfumes.*') ? 'active' : '' }}"
                               href="{{ route('staff.perfumes.index') }}">
                            <i class="bi bi-droplet-half me-2"></i>Stock</a></li>
                    @endif
                </ul>
                <hr>
                <a class="nav-link" href="{{ route('collection') }}"><i class="bi bi-shop me-2"></i>View shop</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link text-danger w-100 text-start border-0 bg-transparent">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="col-lg-10 col-md-9 admin-content bg-light py-4 px-3 px-lg-5">
            <div class="admin-topbar d-flex justify-content-between align-items-center mb-4">
                <div><span class="eyebrow">{{ $isAdmin ? 'Flowers administration' : 'Flowers operations' }}</span><h1 class="font-display h3 mb-0">{{ $isAdmin ? 'Control room' : 'Work space' }}</h1></div>
                <span class="user-chip"><i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}</span>
            </div>
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>