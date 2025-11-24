<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SHE Management</title>

    <!-- Default pakai CDN -->
    <link id="bootstrapCSS" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e4f5 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }
        .auth-card {
            width: 100%;
            max-width: 550px;
            background-color: #fff;
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            animation: fadeIn 0.6s ease;
        }
        .form-control:focus {
            border-color: #4a81d4;
            box-shadow: 0 0 0 0.2rem rgba(74,129,212,0.25);
        }
        .btn-primary:hover {
            background-color: #386bb7;
            transform: translateY(-2px);
            transition: all 0.3s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script>
        // Kalau offline, ganti CSS bootstrap ke file lokal
        window.addEventListener('load', function() {
            if (!navigator.onLine) {
                document.getElementById('bootstrapCSS').href = "{{ asset('template/dist/assets/css/bootstrap.min.css') }}";
                console.warn("Offline mode detected — using local bootstrap.min.css");
            }
        });
    </script>
</head>
<body>

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="auth-card text-center">
        <a href="#" class="logo d-inline-block mb-3">
            <img src="{{ asset('template/logo/logo.png') }}" alt="logo" style="width: 220px;">
        </a>

        <form method="POST" action="#">
            {{-- @csrf nanti diisi --}}
            @if (session('error'))
                <div class="alert alert-danger py-2">{{ session('error') }}</div>
            @endif

            <div class="mb-3 text-start">
                <label class="form-label fw-semibold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="ri-user-line text-primary"></i></span>
                    <input type="text" name="username" class="form-control border-start-0" placeholder="Enter username">
                </div>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label fw-semibold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="ri-lock-line text-primary"></i></span>
                    <input type="password" id="password" name="password" class="form-control border-start-0" placeholder="Enter password">
                    <span class="input-group-text bg-white border-start-0" id="togglePassword" style="cursor: pointer;">
                        <i class="ri-eye-line"></i>
                    </span>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label text-muted" for="remember">Remember me</label>
                </div>
                <a href="#" class="text-primary fw-semibold text-decoration-none">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-lg fw-semibold shadow-sm mb-3">Log In</button>

            <p class="text-muted small mb-0">
                © {{ date('Y') }} <strong>SHE Management</strong>. All rights reserved.
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');
    togglePassword.addEventListener('click', function () {
        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        this.innerHTML = type === 'password'
            ? '<i class="ri-eye-line"></i>'
            : '<i class="ri-eye-off-line"></i>';
    });
</script>

</body>
</html>
