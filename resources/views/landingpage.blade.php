@extends('layouts.app')

@section('title', 'Beranda - Rental Camera')

@section('styles')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
        }

        main {
            width: 100%;
            overflow-x: hidden;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('{{ asset("images/camera-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 15px;
            text-align: center;
            width: 100%;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .full-width-section {
            width: 100%;
            padding: 80px 15px;
        }

        .section-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .equipment-section {
            background-color: var(--light-color);
        }

        .equipment-card {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .equipment-card:hover {
            transform: scale(1.03);
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: var(--primary-color);
            border-radius: 2px;
        }
    </style>
@endsection

@section('content')
     <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-4">Sewa Kamera Profesional Berkualitas</h1>
            <p class="lead mb-5">Solusi tepat untuk kebutuhan fotografi Anda dengan harga terjangkau</p>
            <a href="{{ route('kataloguser') }}" class="btn btn-primary btn-lg px-4 me-2"><i class="fas fa-camera me-2"></i> Pesan Sekarang</a>
            <a href="#features" class="btn btn-outline-light btn-lg px-4"><i class="fas fa-info-circle me-2"></i> Pelajari Lebih Lanjut</a>
        </div>
    </section>

    <!-- Keunggulan Layanan -->
    <section id="features" class="full-width-section">
        <div class="section-content">
            <h2 class="text-center section-title">Mengapa Memilih Kami?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Kualitas Terjamin</h3>
                        <p>Kamera dan peralatan kami selalu dalam kondisi prima dengan perawatan berkala oleh teknisi profesional.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center">
                        <div class="feature-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h3>Harga Kompetitif</h3>
                        <p>Harga sewa yang terjangkau dengan berbagai pilihan paket sesuai kebutuhan dan budget Anda.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 text-center">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3>Dukungan 24/7</h3>
                        <p>Tim support kami siap membantu kapan saja melalui WhatsApp, telepon, atau email.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Penjelasan Peralatan -->
    <section class="full-width-section equipment-section">
        <div class="section-content">
            <h2 class="text-center section-title">Peralatan Profesional Kami</h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="equipment-card bg-white p-4">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('images/dslr-camera.jpg') }}" alt="DSLR Camera" class="img-fluid rounded">
                            </div>
                            <div class="col-md-8">
                                <h3>Kamera DSLR</h3>
                                <p>Kami menyediakan berbagai merek DSLR profesional seperti Canon, Nikon, dan Sony dengan lensa berkualitas tinggi untuk berbagai kebutuhan fotografi.</p>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-primary me-2"></i> Resolusi tinggi</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Auto-focus cepat</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Low-light performance</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="equipment-card bg-white p-4">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('images/mirrorless.jpg') }}" alt="Mirrorless Camera" class="img-fluid rounded">
                            </div>
                            <div class="col-md-8">
                                <h3>Kamera Mirrorless</h3>
                                <p>Solusi ringkas dengan kualitas tak kalah dari DSLR. Tersedia berbagai pilihan mirrorless dari Sony, Fujifilm, dan Canon dengan teknologi terkini.</p>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-primary me-2"></i> Compact dan ringan</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> 4K video recording</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Image stabilization</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="equipment-card bg-white p-4">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('images/lens.jpg') }}" alt="Camera Lenses" class="img-fluid rounded">
                            </div>
                            <div class="col-md-8">
                                <h3>Lensa Kamera</h3>
                                <p>Koleksi lengkap lensa untuk berbagai kebutuhan fotografi mulai dari wide-angle, telephoto, hingga macro lens dengan aperture lebar.</p>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-primary me-2"></i> Berbagai focal length</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Kualitas optik prima</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Kompatibel multi-mount</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="equipment-card bg-white p-4">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <img src="{{ asset('images/accessories.jpg') }}" alt="Camera Accessories" class="img-fluid rounded">
                            </div>
                            <div class="col-md-8">
                                <h3>Aksesoris Fotografi</h3>
                                <p>Lengkapi kebutuhan fotografi Anda dengan berbagai aksesoris profesional seperti tripod, flash, gimbal, dan peralatan pendukung lainnya.</p>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-primary me-2"></i> Tripod stabil</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> External flash</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Drone photography</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="full-width-section py-5 bg-primary text-white ">
        <div class="section-content text-center">
            <h2 class="mb-4">Siap Memulai Proyek Fotografi Anda?</h2>
            <p class="lead mb-4">Temukan peralatan terbaik untuk kebutuhan kreatif Anda dengan harga terjangkau.</p>
            <a href="#contact" class="btn btn-light btn-lg px-4"><i class="fas fa-phone-alt me-2"></i> Hubungi Kami</a>
        </div>
    </section>
@endsection
