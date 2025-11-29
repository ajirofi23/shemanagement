@extends('layout.sidebar')

@section('content')

<style>
    /* ----------------------------------------------------- */
    /* 1. VARIABEL & BASE STYLES */
    /* ----------------------------------------------------- */
    :root {
        --sidebar-width: 260px; /* Dipertahankan untuk kalkulasi margin/left */
        --card-bg: #f8fafc;
        --card-border: #e2e8f0;
        --content-bg: #ffffff;
        --text-dark: #1f2937;
        --muted: #6b7280;
        --accent: #ef4b64;
        --gap-size: 18px; 
    }
    * { box-sizing: border-box; }
    html, body { 
        height: 100%; 
        margin: 0;
        font-family: 'Poppins', sans-serif; 
        color: var(--text-dark);
        background: var(--content-bg);
        overflow-x: hidden;
    }

    /* ----------------------------------------------------- */
    /* 2. LAYOUT: TOPBAR & CONTENT (Fokus Penempatan) */
    /* ----------------------------------------------------- */

    /* Top bar: Diperlukan untuk memastikan konten tidak menimpanya */
    .topbar {
        position: fixed;
        top: 0; 
        left: var(--sidebar-width); 
        right: 0;
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
    .user-avatar { /* Menyertakan user-avatar untuk kelengkapan topbar */
        display: inline-block; width: 24px; height: 24px; line-height: 24px;
        text-align: center; border-radius: 50%; background: #4b5563;
        color: #fff; margin-right: 8px; font-size: 12px;
    }
    .user-name { font-weight: 600; }

    /* Content Area */
    .content {
        margin-left: var(--sidebar-width); 
        padding: 22px;
        padding-top: 60px; /* MODIFIKASI: Mengurangi padding atas agar lebih ke atas (56px topbar + sedikit margin) */
        min-height: 100vh;
    }
    .content-inner {
        max-width: 1300px; 
        margin: 0 auto;
    }
    
    .page-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 2px; /* Disederhanakan */
        color: #0f172a;
    }
    .page-subtitle {
        color: var(--muted);
        margin-bottom: var(--gap-size);
        font-size: 0.95rem;
    }

    /* ----------------------------------------------------- */
    /* 3. CARD STYLES */
    /* ----------------------------------------------------- */
    .card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%; 
    }
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .card .card-header {
        padding: 14px 18px;
        font-weight: 700;
        border-bottom: 1px solid var(--card-border);
        background: #f1f5f9;
        font-size: 1rem; 
    }
    .card .card-body {
        padding: 22px 18px;
        font-size: 40px;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-grow: 1; 
    }
    .card-total { 
        grid-column: 1 / -1; 
        display: flex;
        flex-direction: column;
    }
    .card-total .card-body { font-size: 48px; }

    /* ----------------------------------------------------- */
    /* 4. GRID LAYOUTS & RESPONSIVENESS */
    /* ----------------------------------------------------- */
    .grid { 
        display: grid; 
        gap: var(--gap-size); 
    }
    .grid-tiles { 
        grid-template-columns: repeat(2, 1fr); 
        margin-top: var(--gap-size);
    }

    @media (min-width: 1024px) {
        .grid-tiles {
            grid-template-columns: repeat(4, 1fr); 
        }
        @media (min-width: 1400px) {
            .grid-tiles {
                grid-template-columns: repeat(3, 1fr); 
            }
        }
    }

    @media (max-width: 767px) {
        .content { 
            margin-left: 0; 
            padding: 16px; 
            padding-top: 60px; /* MODIFIKASI: Konsisten 60px */
        }
        .topbar {
            left: 0; 
        }
        .grid-tiles { 
            grid-template-columns: 1fr; 
        }
        .page-title, .page-subtitle { 
            text-align: center; 
            margin-bottom: 10px;
        }
    }

    /* ----------------------------------------------------- */
    /* 5. ANIMASI */
    /* ----------------------------------------------------- */
    .fade-up {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease, transform 0.6s cubic-bezier(0.16,1,0.3,1);
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
        </section>

        <section class="grid" style="margin-top:var(--gap-size);">
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