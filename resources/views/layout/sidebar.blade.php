<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHE Dashboard – PT AICC</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR ONLY */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #717d8b 0%, #64707e 100%);
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 24px 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            z-index: 999;
        }
        .brand { font-size: 1.8rem; font-weight: 800; text-align: center; padding: 0 1.25rem 2rem; letter-spacing: -1px; color: white; }
        .menu { list-style: none; padding: 0 0 2rem; margin: 0; flex: 1; }
        .menu a {
            display: flex; align-items: center; gap: 14px;
            padding: 0.9rem 1.5rem; color: rgba(255, 255, 255, 0.92);
            text-decoration: none; font-weight: 500; font-size: 1rem;
            transition: 0.25s; border-left: 4px solid transparent;
        }
        .menu a:hover { background: rgba(255, 255, 255, 0.12); color: white; }
        .menu a.active { background: rgba(255, 255, 255, 0.2); color: white; border-left-color: #60a5fa; }
        .logout { padding: 0 1.25rem; }
        .logout-btn { width: 100%; padding: 0.85rem 1.5rem; background: #dc2626; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <div class="brand">
            <img src="{{ asset('template/logo/logo.png') }}" alt="AICC Logo"
                 style="max-width: 160px; height: auto; display: block; margin: 0 auto;">
        </div>

        <ul class="menu">
            <li>
                <a href="{{ route('she.dashboard') }}"
                   class="{{ request()->routeIs('she.dashboard') ? 'active' : '' }}">
                   <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('she.hyarihatto') }}"
                   class="{{ request()->routeIs('she.hyarihatto') ? 'active' : '' }}">
                   <i class="bi bi-exclamation-circle"></i> Hyari Hatto
                </a>
            </li>

            {{-- EDIT: ganti "#" menjadi route she.insiden + aktifkan state --}}
            <li>
                <a href="{{ route('she.insiden') }}"
                   class="{{ request()->routeIs('she.insiden') ? 'active' : '' }}">
                   <i class="bi bi-exclamation-triangle"></i> Insiden
                </a>
            </li>

            {{-- EDIT: ganti "#" menjadi route she.komitmenk3 + aktifkan state --}}
            <li>
                <a href="{{ route('she.komitmenk3') }}"
                   class="{{ request()->routeIs('she.komitmenk3') ? 'active' : '' }}">
                   <i class="bi bi-shield-check"></i> Komitmen K3
                </a>
            </li>

            <!-- CHANGED: Safety Riding now uses a named route + active state -->
            <li>
                <a href="{{ route('she.safetyriding') }}"
                   class="{{ request()->routeIs('she.safetyriding') ? 'active' : '' }}">
                   <i class="bi bi-bicycle"></i> Safety Riding
                </a>
            </li>
            <li><a href="#"><i class="bi bi-binoculars"></i> Safety Patrol</a></li>
        </ul>

        <div class="logout">
            <button type="button" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </div>
    </nav>

    <!-- Main Content (Contoh sederhana) -->
    {{-- <div style="margin-left: 260px; padding: 2rem; background: #f9fafb; min-height: 100vh;">
        <h1 style="color: #0f172a;">SHE Dashboard – PT AICC</h1>
        <p class="text-muted">Welcome to the SHE Monitoring System.</p>
    </div> --}}

    <!-- MAIN CONTENT -->
    <div class="main-content" style="margin-left:10px; padding:2rem; background:#f9fafb; min-height:100vh;">
    @yield('content')
</div>

</body>
</html>
