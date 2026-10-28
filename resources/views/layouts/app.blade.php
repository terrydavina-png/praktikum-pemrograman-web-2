<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Perpustakaan') | Data Buku</title>

    {{-- Tema Litera (Bootswatch)  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.8/litera/bootstrap.min.css" rel="stylesheet">

    {{-- Tempat CSS tambahan khusus halaman tertentu --}}
    @stack('styles')
</head>
<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/buku">Perpustakaan</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menuUtama" aria-controls="menuUtama"
                    aria-expanded="false" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuUtama">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('buku*') ? 'active' : '' }}" href="/buku">Data Buku</a>
                    </li>
                </ul>

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center gap-2 mb-0">
                        @csrf
                        <span class="navbar-text">Halo, {{ Auth::user()->name }}</span>
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Tempat JavaScript tambahan khusus halaman tertentu --}}
    @stack('scripts')
</body>
</html>