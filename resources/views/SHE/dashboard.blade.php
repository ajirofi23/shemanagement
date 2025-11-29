{{-- SHE Dashboard --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>SHE Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Load Poppins correctly -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #778096;
            --sidebar-hover: #6c758b;
            --card-bg: #f8fafc;
            --card-border: #e2e8f0;
            --content-bg: #ffffff;
            --text-dark: #1f2937;
            --muted: #6b7280;
            --accent: #ef4b64;
            --hover-bg: #f1f5f9;
            --active-border: #60a5fa;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: 'Poppins', -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
            color: var(--text-dark);
            background: var(--content-bg);
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 180px;
            height: 100vh;
            background: var(--sidebar-bg);
            color: #fff;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .brand {
            padding: 16px 14px;
            font-weight: 800;
            font-size: 28px;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .brand i {
            font-size: 24px;
            color: #dc2626;
        }
        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }
        .menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
            border-left: 4px solid transparent;
        }
        .menu li a:hover,
        .menu li a.active {
            background: var(--sidebar-hover);
            color: white;
        }
        .menu li a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--active-border);
        }
        .menu li a i {
            font-size: 1.1rem;
        }
        .logout {
            padding: 14px;
            border-top: 1px solid rgba(255,255,255,0.15);
        }
        .logout-btn {
            width: 100%;
            padding: 10px 12px;
            border: none;
            border-radius: 6px;
            background: var(--accent);
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(239, 75, 100, 0.3);
            text-align: left;
        }
        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(239, 75, 100, 0.4);
        }
        .logout-btn i {
            font-size: 1rem;
        }

        /* Top bar */
        .topbar {
            position: fixed;
            top: 0; left: 180px; right: 0;
            height: 56px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 18px;
            z-index: 5;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .user-avatar {
            display: inline-block;
            width: 24px; height: 24px;
            line-height: 24px;
            text-align: center;
            border-radius: 50%;
            background: #4b5563;
            color: #fff;
            margin-right: 8px;
            font-size: 12px;
        }
        .user-name { font-weight: 600; }

        /* Content */
        .content {
            margin-left: 180px;
            padding: 22px;
            padding-top: 78px; /* space for topbar */
        }
        /* NEW: center and constrain content for better readability */
        .content-inner {
            max-width: 1200px;
            margin: 0 auto;
        }
        .page-title {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 4px;
            color: #0f172a;
        }
        .page-subtitle {
            color: var(--muted);
            margin-bottom: 16px;
            font-size: 0.95rem;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
        /* Tweak header styling */
        .card .card-header {
            padding: 14px 18px;            /* was: 12px 16px */
            font-weight: 700;
            border-bottom: 1px solid var(--card-border); /* unify border style */
            background: #f1f5f9;
        }
        /* Slightly reduce font size for better balance on most screens */
        .card .card-body {
            padding: 22px 18px;            /* was: 20px 16px */
            font-size: 40px;               /* was: 42px */
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .grid {
            display: grid;
            gap: 18px;
        }

        .card-total {
            grid-column: 1 / -1;
        }
        .card-total .card-body {
            font-size: 48px;
        }

        /* Make tiles auto-fit to available width */
        .grid-tiles {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* was: repeat(3, 1fr) */
        }

        .grid-bottom {
            grid-template-columns: 1fr;
        }

        /* Animations */
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            /* keep tiles adaptive; min width is handled by auto-fit */
        }
        @media (max-width: 720px) {
            .topbar { left: 0; }
            .content { margin-left: 0; padding-top: 70px; }
            .sidebar { position: static; width: 100%; height: auto; }
            .grid-tiles { grid-template-columns: 1fr; } /* ensures single column if space is really tight */
            /* Better mobile typography */
            .page-title, .page-subtitle { text-align: center; }
            .card .card-body { font-size: 34px; } /* slightly smaller for mobile */
        }
    </style>
</head>
<body>

    @include('layout.sidebar')
    @include('layout.header')

    <main class="content">
        <!-- NEW: centered container -->
        <div class="content-inner">
            <div class="page-title fade-up">DASHBOARD MONITORING</div>
            <div class="page-subtitle fade-up">Summary of safety performance AICC</div>

            <section class="grid">
                <div class="card card-total fade-up">
                    <div class="card-header">Total Safety Work Day</div>
                    <div class="card-body">682</div>
                </div>
            </section>

            <section class="grid grid-tiles" style="margin-top:18px;">
                <div class="card fade-up">
                    <div class="card-header">Work Accident (Loss day)</div>
                    <div class="card-body">0</div>
                </div>
                <div class="card fade-up">
                    <div class="card-header">Work Accident (Light)</div>
                    <div class="card-body">0</div>
                </div>
                <div class="card fade-up">
                    <div class="card-header">Traffic Accident</div>
                    <div class="card-body">0</div>
                </div>
                <div class="card fade-up">
                    <div class="card-header">Fire Accident</div>
                    <div class="card-body">0</div>
                </div>
                <div class="card fade-up">
                    <div class="card-header">Forklift Accident</div>
                    <div class="card-body">0</div>
                </div>
                <!-- FIX: typo Insident -> Incident -->
                <div class="card fade-up">
                    <div class="card-header">Molten Spill Incident</div>
                    <div class="card-body">0</div>
                </div>
            </section>

            <section class="grid grid-bottom" style="margin-top:18px;">
                <div class="card fade-up">
                    <!-- FIX: typo Insident -> Incident -->
                    <div class="card-header">Property Damage Incident</div>
                    <div class="card-body">0</div>
                </div>
            </section>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: "0px 0px -60px 0px"
            });

            document.querySelectorAll('.fade-up').forEach(el => {
                observer.observe(el);
            });
        });
    </script>

</body>
</html>