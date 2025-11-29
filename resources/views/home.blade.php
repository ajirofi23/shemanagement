<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SHE Department – Safety, Health & Environment excellence at PT AICC.">
    <title>SHE Department – PT AICC</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            line-height: 1.6;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        .navbar {
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            backdrop-filter: blur(0);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.7rem;
            color: #1e40af;
            letter-spacing: -0.8px;
        }

        .nav-link {
            color: #475569 !important;
            font-weight: 600;
            padding: 0.65rem 1.2rem;
            border-radius: 12px;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .nav-link:hover {
            color: #2563eb !important;
            background: rgba(37, 99, 235, 0.08);
        }

        /* Hero */
        .hero {
            padding: 8rem 1rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%);
            border-radius: 24px;
            margin: 2.5rem auto 4rem;
            max-width: 1240px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -60%;
            right: -40%;
            width: 900px;
            height: 900px;
            background: radial-gradient(circle, rgba(37,99,235,0.04) 0%, transparent 70%);
            z-index: 0;
        }

        .hero > .row {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-weight: 800;
            font-size: 3.2rem;
            color: #0f172a;
            line-height: 1.15;
            margin-bottom: 1.5rem;
            letter-spacing: -1.2px;
        }

        .hero p {
            font-size: 1.2rem;
            color: #334155;
            max-width: 720px;
            margin-bottom: 2.5rem;
            opacity: 0.95;
        }

        .btn {
            font-weight: 600;
            padding: 0.85rem 2.4rem;
            border-radius: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(120deg, #2563eb, #1d4ed8);
            border: none;
            color: white;
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 28px rgba(37, 99, 235, 0.6);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #3b82f6;
            color: #2563eb;
            font-weight: 600;
        }

        .btn-outline:hover {
            background: rgba(37, 99, 235, 0.12);
            transform: translateY(-5px);
            box-shadow: 0 8px 22px rgba(37, 99, 235, 0.28);
        }

        /* Stats */
        .stats-section {
            background: #ffffff;
            padding: 4rem 1.5rem;
            margin: 4rem 0;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #2563eb, #7c3aed);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(90deg, #2563eb, #7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        /* Features */
        .feature-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            position: relative;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .feature-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, rgba(37,99,235,0.02), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 16px 40px rgba(0,0,0,0.14);
            border-color: #cbd5e1;
        }

        .feature-card:hover::after {
            opacity: 1;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 18px;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.6rem;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.2);
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, #c7d2fe, #dbeafe);
            box-shadow: 0 8px 22px rgba(37, 99, 235, 0.35);
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
            color: #0f172a;
            font-weight: 700;
        }

        .feature-card p {
            color: #475569;
            font-size: 1rem;
            opacity: 0.92;
            line-height: 1.7;
        }

        /* About */
        .commitment-box {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 2.4rem;
            height: 100%;
            transition: all 0.4s ease;
        }

        .commitment-box:hover {
            border-color: #cbd5e1;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        /* CTA */
        .cta-section {
            text-align: center;
            padding: 6rem 2rem;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 24px;
            margin: 5rem 0;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            border: 1px solid #bae6fd;
            box-shadow: 0 12px 32px rgba(37,99,235,0.08);
        }

        .cta-section h2 {
            font-weight: 800;
            font-size: 2.6rem;
            color: #0c4a6e;
            margin-bottom: 1.4rem;
        }

        .cta-section p {
            color: #334155;
            margin-bottom: 2.5rem;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.15rem;
        }

        /* Footer */
        .footer {
            background: #ffffff;
            padding: 4.5rem 0 3rem;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 0.95rem;
            margin-top: 3rem;
        }

        .footer h5 {
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1.4rem;
            font-size: 1.2rem;
        }

        .footer a {
            color: #2563eb;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }

        .footer a:hover {
            text-decoration: underline;
            color: #1d4ed8;
        }

        .footer-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 2.5rem 0;
        }

        /* Animations */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* === Page Load Transition === */
        body.page-loading {
            opacity: 0;
            transition: opacity 0.45s cubic-bezier(0.23, 1, 0.32, 1);
        }
        body.page-loaded {
            opacity: 1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.4rem;
            }
            .btn-group-hero {
                flex-direction: column;
                gap: 1rem;
            }
            .hero {
                padding: 5.5rem 1rem;
            }
            .stat-number {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body class="page-loading">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">SHE Department – PT AICC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#features">Capabilities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container">
        <section class="hero fade-up">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center text-lg-start">
                    <h1>Excellence in Safety, Health & Environment</h1>
                    <p>
                        The SHE Department at PT AICC ensures a zero-harm workplace, regulatory compliance, and sustainable operations across all facilities protecting people, planet, and productivity.
                    </p>
                    <div class="d-flex gap-3 btn-group-hero">
                        <a href="#contact" class="btn btn-primary">Contact Us</a>
                        <a href="#features" class="btn btn-outline">Our Capabilities</a>
                    </div>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0 text-center">
                    <div style="background: linear-gradient(135deg, #dbeafe, #eff6ff); border-radius: 20px; height: 400px; display: flex; align-items: center; justify-content: center; box-shadow: 0 12px 30px rgba(37,99,235,0.18);">
                        <img src="{{ asset('template/logo/logo.png') }}" alt="PT AICC Logo" style="max-width: 90%; max-height: 90%; object-fit: contain;">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Stats -->
    <div class="container">
        <div class="stats-section fade-up">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="stat-number">100%</div>
                    <p>Regulatory Compliance</p>
                </div>
                <div class="col-md-4">
                    <div class="stat-number">0</div>
                    <p>Lost-Time Incidents (YTD)</p>
                </div>
                <div class="col-md-4">
                    <div class="stat-number">5+</div>
                    <p>Years of Zero Major Accidents</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Certifications -->
    <section class="container py-5">
        <div class="text-center mb-5 fade-up">
            <h2 class="fw-bold" style="color: #0f172a;">Certifications & Standards</h2>
            <p class="text-muted" style="max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                PT AICC maintains the highest international and national standards in Safety, Health, and Environment.
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card fade-up text-center" style="padding: 2rem;">
                    <div class="feature-icon" style="margin: 0 auto;">
                        <i class="bi bi-patch-check-fill" style="font-size: 2.2rem; color: #10b981;"></i>
                    </div>
                    <h3 class="mt-3">ISO 45001:2018</h3>
                    <p>Occupational Health & Safety Management System certified since 2020.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                    <div class="feature-card fade-up text-center" style="padding: 2rem;">
                        <div class="feature-icon" style="margin: 0 auto;">
                            <i class="bi bi-recycle" style="font-size: 2.2rem; color: #0ea5e9;"></i>
                        </div>
                        <h3 class="mt-3">ISO 14001:2015</h3>
                        <p>Environmental Management System compliant with global best practices.</p>
                    </div>
                </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card fade-up text-center" style="padding: 2rem;">
                    <div class="feature-icon" style="margin: 0 auto;">
                        <i class="bi bi-award" style="font-size: 2.2rem; color: #8b5cf6;"></i>
                    </div>
                    <h3 class="mt-3">SMK3</h3>
                    <p>Sistem Manajemen Keselamatan dan Kesehatan Kerja certified by Ministry of Manpower.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card fade-up text-center" style="padding: 2rem;">
                    <div class="feature-icon" style="margin: 0 auto;">
                        <i class="bi bi-bank" style="font-size: 2.2rem; color: #f59e0b;"></i>
                    </div>
                    <h3 class="mt-3">PROPER Emas</h3>
                    <p>Gold rating from the Ministry of Environment and Forestry for environmental performance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="container py-5">
        <div class="text-center mb-5 fade-up">
            <h2 class="fw-bold" style="color: #0f172a;">Core SHE Capabilities at PT AICC</h2>
            <p class="text-muted" style="max-width: 650px; margin: 0 auto; font-size: 1.05rem;">
                Integrated programs aligned with ISO 45001, ISO 14001, and national safety standards.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3>Regulatory Compliance</h3>
                    <p>Full adherence to Indonesian and international SHE regulations with real-time monitoring and audit readiness.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h3>Occupational Health</h3>
                    <p>Comprehensive health surveillance, exposure control, and wellness programs for all employees and contractors.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-globe2"></i>
                    </div>
                    <h3>Environmental Stewardship</h3>
                    <p>Waste management, emissions control, and resource efficiency to minimize environmental footprint.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <h3>Incident Prevention</h3>
                    <p>Proactive hazard identification, risk assessment, and near-miss reporting to prevent accidents before they occur.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-file-earmark-bar-graph"></i>
                    </div>
                    <h3>SHE Performance Analytics</h3>
                    <p>Real-time dashboards tracking KPIs, trends, and corrective actions for continuous improvement.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-cloud-check"></i>
                    </div>
                    <h3>Training & Competency</h3>
                    <p>Role-based SHE training, certification tracking, and emergency drills for all personnel.</p>
                </div>
            </div>
            <!-- Newly Added Capabilities -->
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h3>Site Safety Audits</h3>
                    <p>Regular internal and third-party audits to ensure compliance, identify gaps, and drive corrective actions.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3>Contractor SHE Management</h3>
                    <p>End-to-end oversight of contractor safety protocols, orientation, and performance evaluation.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card fade-up">
                    <div class="feature-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h3>Emergency Preparedness</h3>
                    <p>Robust emergency response plans, crisis simulations, and cross-functional response teams.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 fade-up">
                <h2 class="fw-bold mb-3" style="color: #0f172a;">About SHE Department – PT AICC</h2>
                <p class="text-muted mb-3">
                    The SHE Department is the cornerstone of PT AICC’s commitment to operational excellence. We embed safety and sustainability into every process, ensuring a healthy workplace and responsible environmental practices.
                </p>
                <p class="text-muted">
                    Our team of certified professionals drives a culture where every employee goes home safely every day.
                </p>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0 fade-up">
                <div class="commitment-box">
                    <h5 class="fw-bold mb-3" style="color: #1e40af;">Our Commitments</h5>
                    <ul class="list-unstyled" style="color: #475569; font-size: 1rem;">
                        <li class="mb-2">✅ Zero Harm Workplace</li>
                        <li class="mb-2">✅ 100% Compliance with Government Regulations</li>
                        <li class="mb-2">✅ Continuous Environmental Improvement</li>
                        <li class="mb-2">✅ Empowered & Trained Workforce</li>
                        <li class="mb-2">✅ Transparent SHE Reporting</li>
                        <li class="mb-2">✅ Community Health & Safety Engagement</li>
                        <li>✅ Innovation in Sustainable Operations</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <div class="container">
        <div class="cta-section fade-up">
            <h2>Committed to Excellence in Every Operation</h2>
            <p>PT AICC’s SHE Department leads by example turning safety and sustainability into core business values.</p>
            <a href="#contact" class="btn btn-primary">Reach Out to Our Team</a>
        </div>
    </div>

    <!-- Contact & Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0 fade-up">
                    <h5>SHE Department – PT AICC</h5>
                    <p class="text-muted" style="font-size: 0.95rem; line-height: 1.7;">
                        Driving a culture of safety, health, and environmental responsibility across all PT AICC operations since 2015.
                    </p>
                </div>
                <div class="col-md-3 fade-up">
                    <h5>Resources</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('she.policies') }}">SHE Policies</a></li>
                        <li><a href="{{ route('training.materials') }}">Training Materials</a></li>
                        <li><a href="#">Incident Reports</a></li>
                        <li><a href="#">Sustainability Reports</a></li>
                    </ul>
                </div>
                <div class="col-md-3 fade-up">
                    <h5 id="contact">Contact</h5>
                    <ul class="list-unstyled">
                        <li>✉️ publicrelation@ijtt-id.com</li>
                        <li>📞 +62 21 8904590</li>
                        <li>📍 Karawang Internasional Industry City (KIIC)</li>
                    </ul>
                </div>
            </div>
            <div class="footer-divider"></div>
            <div class="text-center text-muted fade-up">
                © {{ date('Y') }} SHE Department – PT AICC. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scroll & Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll with offset for sticky navbar
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const offsetTop = targetElement.offsetTop - 80;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Fade-up animation on scroll
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

    <!-- === Page Load Fade-In Animation === -->
    <script>
        // Trigger fade-in on page load
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.body.classList.add('page-loaded');
                document.body.classList.remove('page-loading');
            }, 50);
        });
    </script>
</body>
</html>
