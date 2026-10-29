<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Data Buku</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.8/litera/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
        <div class="col-md-6 col-lg-4">

            <div class="text-center mb-4">
                <h1 class="h3 text-primary mb-1">Perpustakaan</h1>
                <p class="text-muted mb-0">Silakan login untuk mengelola data buku</p>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login.authenticate') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" autocomplete="email" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   autocomplete="current-password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>
</html>