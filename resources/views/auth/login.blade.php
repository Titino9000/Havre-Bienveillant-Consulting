<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HBC CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body { background-color: var(--bg-light); display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .login-card { max-width: 400px; width: 100%; border-radius: var(--radius-lg); padding: 40px; background: white; box-shadow: var(--shadow-soft); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-gradient">HBC CMS</h3>
            <p class="text-muted">Sign in to manage your content</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-3 rounded-3">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-3 rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control form-control-lg" id="password" name="password" required>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-muted" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn-premium w-100">Login</button>
        </form>
    </div>
</body>
</html>
