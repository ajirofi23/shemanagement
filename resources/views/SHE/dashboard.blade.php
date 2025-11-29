@extends('layout.sidebar')
@include('layout.header')
@section('content')

<style>
    /* ----------------------------------------------------- */
    /* 1. VARIABEL GLOBAL (Modern + Premium Look) */
    /* ----------------------------------------------------- */
    :root {
        --sidebar-width: 260px;
        --bg-main: #f5f7fb;
        --bg-card: #ffffffcc;
        --bg-card-hover: #ffffffee;
        --border-soft: rgba(0,0,0,0.08);
        --text-dark: #0f172a;
        --text-muted: #64748b;
        --accent: #4f46e5;
        --accent-soft: #eef2ff;
        --gap-size: 20px;
        --radius: 14px;
    }

    * { box-sizing: border-box; }

    html, body {
        height: 100%;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: var(--bg-main);
        color: var(--text-dark);
        overflow-x: hidden;
    }

    /* ----------------------------------------------------- */
    /* 2. CONTENT AREA */
    /* ----------------------------------------------------- */
    .content {
        margin-left: var(--sidebar-width);
        padding: 30px;
        padding-top: 70px;
        min-height: 100vh;
        animation: fadeMain 0.7s ease-out;
    }

    @keyframes fadeMain {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .content-inner {
    max-width: 1200px;   /* dari 1350 jadi lebih sempit */
    margin: 0 auto;
}


    .page-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 4px;
        color: #111827;
        letter-spacing: -0.8px;
        animation: fadeUp 0.6s ease-out;
    }

    .page-subtitle {
        font-size: 15px;
        color: var(--text-muted);
        margin-bottom: 26px;
        animation: fadeUp 0.75s ease-out;
    }

    /* ----------------------------------------------------- */
    /* 3. GRID SYSTEM */
    /* ----------------------------------------------------- */
    .grid { display: grid; gap: var(--gap-size); }

    .grid-tiles {
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); /* lebih kecil */
    margin-top: var(--gap-size);
    gap: 16px; /* grid lebih rapat */
}


    @media (max-width: 768px) {
        .content {
            margin-left: 0;
            padding: 22px;
            padding-top: 70px;
        }
        .page-title, .page-subtitle {
            text-align: center;
        }
    }

    /* ----------------------------------------------------- */
    /* 4. CARD MODERN PREMIUM */
    /* ----------------------------------------------------- */
    .card {
        background: var(--bg-card);
        border: 1px solid var(--border-soft);
        border-radius: var(--radius);
        overflow: hidden;
        padding: 0;
        backdrop-filter: blur(6px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.05);
        transition: 0.35s ease-in-out;
        animation: fadeUp 0.65s ease-out;
        transform-origin: center;
    }

    .card:hover {
        transform: translateY(-6px) scale(1.015);
        background: var(--bg-card-hover);
        box-shadow: 0 12px 32px rgba(0,0,0,0.10);
    }

    .card-header {
        padding: 16px 20px;
        font-weight: 700;
        background: linear-gradient(to right, #f3f4f9, #ffffff);
        border-bottom: 1px solid var(--border-soft);
        font-size: 1rem;
        color: #1e293b;
    }

    .card-body {
        padding: 20px 16px;    /* lebih kecil */
        font-size: 36px;
        font-weight: 800;
        color: var(--accent);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Total card sedikit lebih besar */
    .card-total .card-body {
    font-size: 46px;
    padding: 24px 20px;
}


    /* ----------------------------------------------------- */
    /* 5. ANIMASI */
    /* ----------------------------------------------------- */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-up {
        opacity: 0;
        transform: translateY(25px);
        transition: 0.8s cubic-bezier(.16,1,.3,1);
    }

    .fade-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

</style>


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<main class="content">
    <div class="content-inner">

        <div class="page-title fade-up">DASHBOARD MONITORING</div>
        <div class="page-subtitle fade-up">Summary of safety performance AICC</div>

        <section class="grid">
            <div class="card card-total fade-up">
                <div class="card-header">Total Safety Work Day</div>
                <div class="card-body">682</div>
            </div>
        </section>

        <section class="grid grid-tiles">
    <div class="card fade-up" style="transition-delay: 0.1s;">
        <div class="card-header">Work Accident (Loss day)</div>
        <div class="card-body">0</div>
    </div>
    <div class="card fade-up" style="transition-delay: 0.2s;">
        <div class="card-header">Work Accident (Light)</div>
        <div class="card-body">0</div>
    </div>
    <div class="card fade-up" style="transition-delay: 0.3s;">
        <div class="card-header">Traffic Accident</div>
        <div class="card-body">0</div>
    </div>
    <div class="card fade-up" style="transition-delay: 0.4s;">
        <div class="card-header">Fire Accident</div>
        <div class="card-body">0</div>
    </div>
    <div class="card fade-up" style="transition-delay: 0.5s;">
        <div class="card-header">Forklift Accident</div>
        <div class="card-body">0</div>
    </div>
    <div class="card fade-up" style="transition-delay: 0.6s;">
        <div class="card-header">Molten Spill Incident</div>
        <div class="card-body">0</div>
    </div>

    <!-- DILETAKKAN DI DALAM LIST CARD INI -->
    <div class="card fade-up" style="transition-delay: 0.7s;">
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

@endsection
