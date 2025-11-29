<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHE Dashboard – PT AICC</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* === Sidebar Modern UI === */
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
        font-family: 'Poppins', sans-serif;
        display: flex;
        flex-direction: column;
        z-index: 1000 !important; 
    }

    .main-content {
        margin-left: 260px;
        padding: 2rem;
        background: #f9fafb;
        min-height: 100vh;
        position: relative;
        z-index: 1; 
        overflow-x: auto; 
    }

    body {
        overflow-x: hidden; 
    }

        .brand {
            font-size: 1.8rem;
            font-weight: 800;
            text-align: center;
            padding: 0 1.25rem 2rem;
            letter-spacing: -1px;
            color: white;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .menu {
            list-style: none;
            padding: 0 0 2rem;
            margin: 0;
            flex: 1;
        }

        .menu li {
            margin: 0;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 0.9rem 1.5rem;
            color: rgba(255, 255, 255, 0.92);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            border-left: 4px solid transparent;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            transform: translateX(4px);
        }

        .menu a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-left-color: #60a5fa;
        }

        .menu a i {
            font-size: 1.25rem;
            min-width: 24px;
            text-align: center;
        }

        .logout {
            padding: 0 1.25rem;
        }

        .logout-btn {
            width: 100%;
            padding: 0.85rem 1.5rem;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
        }

        .logout-btn:hover {
            background: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(220, 38, 38, 0.4);
        }

        .logout-btn i {
            font-size: 1.1rem;
        }

        .custom-table-wrapper {
            padding-right: 20px; 
            padding-left: 5px;
            overflow-x: auto;
        }

        .table td, 
        .table th {
            white-space: nowrap; 
        }

        .table img {
            border-radius: 4px;
        }

    </style>
</head>
<body>

    <nav class="sidebar">
        <div class="brand">AICC</div>

        <ul class="menu">
            <li>
                <a href="{{ route('pic.dashboard') }}"
                   class="{{ request()->routeIs('pic.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('pic.laporanhyarihatto') }}"
                   class="{{ request()->routeIs('pic.laporanhyarihatto') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i> Laporan Hyari Hatto
                </a>
            </li>
            
            <li>
                <a href="{{ route('pic.komitmenk3') }}"
                   class="{{ request()->routeIs('pic.komitmenk3') ? 'active' : '' }}">
                    <i class="bi bi-hand-thumbs-up"></i> Komitmen K3
                </a>
            </li>
            
            <li>
                <a href="{{ route('pic.safetypatroltemuan') }}"
                   class="{{ request()->routeIs('pic.safetypatroltemuan') ? 'active' : '' }}">
                    <i class="bi bi-search"></i> Temuan Safety Patrol
                </a>
            </li>
            
            <li>
                <a href="{{ route('pic.safetyridingtemuan') }}"
                   class="{{ request()->routeIs('pic.safetyridingtemuan') ? 'active' : '' }}">
                    <i class="bi bi-bicycle"></i> Temuan Safety Riding
                </a>
            </li>
        </ul>

        <div class="logout">
            <button type="button" class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </div>
    </nav>

    <div class="main-content" style="margin-left:260px; padding:2rem; background:#f9fafb; min-height:100vh;">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>