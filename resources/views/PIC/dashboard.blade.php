@extends('layout.picsidebar')
@extends('layout.header')

@section('content')

<style>
    /* ----------------------------------------------------- */
    /* 1. VARIABEL & BASE STYLES */
    /* ----------------------------------------------------- */
    :root {
        --sidebar-width: 10px; /* Nilai sidebar diasumsikan 260px dari konteks */
        --card-bg: #f8fafc;
        --card-border: #e2e8f0;
        --content-bg: #ffffff;
        --text-dark: #1f2937;
        --muted: #6b7280;
        --accent: #ef4b64;
        --gap-size: 10px; /* MODIFIKASI: Mengurangi gap antar kartu */
        --card-padding-y: 12px; /* MODIFIKASI: Padding vertikal kartu lebih kecil */
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
    /* 2. LAYOUT: TOPBAR & CONTENT */
    /* ----------------------------------------------------- */

    /* Content Area */
    .content {
        /* Asumsi margin-left dikelola oleh layout.picsidebar */
        margin-left: var(--sidebar-width); 
        padding: 16px; /* MODIFIKASI: Mengurangi padding content keseluruhan */
        padding-top: 40px; 
        min-height: 100vh;
        /* Tambahkan min-height agar konten setidaknya setinggi viewport */
        min-height: calc(100vh - 0px); 
    }
    .content-inner {
        max-width: 1300px; 
        margin: 0 auto;
        /* MODIFIKASI: Mengurangi margin/padding di sini juga */
        padding-bottom: 16px; 
    }
    
    .page-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 2px;
        color: #0f172a;
    }
    .page-subtitle {
        color: var(--muted);
        margin-bottom: 10px; /* MODIFIKASI: Mengurangi margin bawah */
        font-size: 0.95rem;
    }

    /* Top bar (Dipertahankan untuk perhitungan padding-top) */
    .topbar {
        position: fixed; top: 0; left: var(--sidebar-width); right: 0;
        height: 56px; background: #fff; border-bottom: 1px solid #e5e7eb;
        display: flex; align-items: center; justify-content: flex-end;
        padding: 0 18px; z-index: 5; box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .user-avatar { display: inline-block; width: 24px; height: 24px; line-height: 24px; text-align: center; border-radius: 50%; background: #4b5563; color: #fff; margin-right: 8px; font-size: 12px; }
    .user-name { font-weight: 600; }

    /* ----------------------------------------------------- */
    /* 3. CARD & GRID STYLES (Fokus Kepadatan) */
    /* ----------------------------------------------------- */
    .card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.03); /* Bayangan lebih tipis */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%; 
        display: flex;
        flex-direction: column;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.06);
    }
    .card .card-header {
        padding: 8px 14px; /* MODIFIKASI: Header lebih tipis */
        font-weight: 700;
        border-bottom: 1px solid var(--card-border);
        background: #f1f5f9;
        font-size: 0.9rem; /* Ukuran font header lebih kecil */
        line-height: 1.2;
    }
    .card .card-body {
        padding: var(--card-padding-y) 14px; /* Menggunakan variabel padding kecil */
        font-size: 30px; /* MODIFIKASI: Ukuran font lebih kecil */
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-grow: 1; 
    }
    .card-total { 
        grid-column: 1 / -1; 
    }
    .card-total .card-body { 
        font-size: 40px; /* MODIFIKASI: Ukuran font total lebih kecil */
    }

    /* Parent Grid Container */
    .dashboard-grid-container {
        display: grid;
        /* MODIFIKASI: Menggunakan fractional unit (1fr) untuk tinggi */
        /* Total: 1 baris besar, 2 baris kartu kecil. 
           Perbandingan (misal): 1.2fr untuk total, 1fr dan 1fr untuk kartu */
        grid-template-rows: 1fr 1fr 1fr; 
        gap: var(--gap-size);
        /* Tinggi Grid adalah sisa ruang yang tersedia di layar (100vh) */
        height: calc(100vh - 60px - 16px - 16px - 40px); /* 100vh - topbar - content_padding_top - content_padding_bottom - title/subtitle_height */
        max-height: 800px; /* Batasan maksimum agar tidak terlalu tinggi di layar 4k */
    }
    
    .grid-tiles { 
        grid-column: 1 / -1; /* Rentang penuh */
        grid-row: 2 / span 2; /* Mencakup baris 2 dan 3 */
        display: grid; 
        gap: var(--gap-size); 
        grid-template-columns: repeat(4, 1fr); /* 4 kolom untuk kartu kecil */
    }
    
    .card-total-section {
        grid-row: 1 / 2; /* Baris pertama untuk total */
        display: contents; /* Biarkan card-total mengambil grid area langsung */
    }

    /* Jika ada 7 kartu kecil, bagi rata */
    .grid-tiles .card:nth-child(7) {
        grid-column: span 1; 
    }
    /* Sisanya diatur oleh auto-fit grid */


    /* ----------------------------------------------------- */
    /* 4. RESPONSIVENESS (Untuk Layar Mobile/Kecil) */
    /* ----------------------------------------------------- */

    @media (min-width: 1024px) {
        /* Penyesuaian untuk layar sangat lebar */
        @media (min-width: 1400px) {
            .grid-tiles {
                grid-template-columns: repeat(4, 1fr); /* 4 kolom tetap lebih baik */
            }
        }
    }

    @media (max-width: 767px) {
        .content { 
            margin-left: 0; 
            padding: 16px; 
            padding-top: 60px;
        }
        .topbar {
            left: 0; 
        }
        
        /* Nonaktifkan grid satu layar di mobile, kembali ke scroll vertikal */
        .dashboard-grid-container {
            height: auto;
            grid-template-rows: auto;
            display: block; /* Kembalikan ke layout block biasa */
        }
        .grid-tiles { 
            margin-top: var(--gap-size);
            grid-template-columns: 1fr; /* 1 kolom penuh */
        }
        .card .card-header {
            font-size: 1rem;
        }
        .card .card-body { 
            font-size: 32px; 
            padding: 18px 16px;
        }
        .card-total .card-body { 
            font-size: 40px; 
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

        <div class="dashboard-grid-container">

            <section class="grid card-total-section">
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
                <div class="card fade-up" style="transition-delay: 0.7s;">
                    <div class="card-header">Property Damage Incident</div>
                    <div class="card-body">0</div>
                </div>
            </section>

        </div>
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