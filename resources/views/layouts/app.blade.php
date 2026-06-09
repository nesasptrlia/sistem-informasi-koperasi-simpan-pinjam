<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koperasi Simpan Pinjam Nesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/dashboard') }}">
                    🏢 Koperasi Simpan Pinjam Nesa
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white" href="{{ route('dashboard') }}">📊 Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white" href="{{ route('anggota.index') }}">👥 Anggota</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white" href="{{ route('simpanan.index') }}">💰 Simpanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white" href="{{ route('pinjaman.index') }}">💸 Pinjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white" href="{{ route('angsuran.index') }}">🧾 Angsuran</a>
                        </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @auth
                        <li class="nav-item">
                            <span class="nav-link text-white fw-bold">👤 {{ Auth::user()->name ?? 'Admin Petugas' }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light fw-semibold">🚪 Logout</button>
                            </form>
                        </li>
                        @endauth

                        @guest
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white" href="{{ route('login') }}">🔑 Login</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('success'))
                <div class="container mt-3">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
