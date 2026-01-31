@extends('layouts.layout')

@section('title', 'Services - EkspImpor')
@section('body_class', 'services-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
        <div class="container">
            <h1>Our Services</h1>
            <p>Layanan ekspor-impor lengkap untuk kebutuhan bisnis global Anda</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Services</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Services Section -->
    <section id="services" class="services section">
        <div class="container section-title" data-aos="fade-up">
            <span>Layanan Kami</span>
            <h2>Solusi Lengkap Ekspor-Impor</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-file-earmark-text"></i></div>
                        <h3>Otomasi Invoice</h3>
                        <p>Buat invoice otomatis dalam hitungan menit. Kurangi waktu pembuatan dari 2 jam menjadi 15 menit per transaksi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-geo-alt"></i></div>
                        <h3>Pelacakan Real-Time</h3>
                        <p>Lacak status penjualan secara real-time. Dari quotation hingga delivered, semua termonitor dalam satu dashboard.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-box-seam"></i></div>
                        <h3>Manajemen Produk</h3>
                        <p>Input data produk lengkap dengan kode HS untuk ekspor-impor, kategorisasi, manajemen stok, dan upload gambar.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-people"></i></div>
                        <h3>Manajemen Mitra</h3>
                        <p>Database relasi bisnis lengkap untuk mengelola customer dan mitra dengan informasi kontak dan riwayat transaksi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
                        <h3>Dashboard & Reporting</h3>
                        <p>Visualisasi data penjualan dengan statistik lengkap. Monitor performa dan trend penjualan dalam satu dashboard.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-item position-relative">
                        <div class="icon"><i class="bi bi-shield-check"></i></div>
                        <h3>Role-Based Access</h3>
                        <p>Sistem login dengan pengaturan akses pengguna terstruktur untuk Owner, Admin, Penjual, dan Pembeli.</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->

    <!-- Features Section -->
    <section id="features" class="features section light-background">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="features-item">
                        <i class="bi bi-speedometer2" style="color: #ffbb2c;"></i>
                        <h3><a href="#">95% Error Berkurang</a></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="features-item">
                        <i class="bi bi-clock" style="color: #5578ff;"></i>
                        <h3><a href="#">15 Menit/Invoice</a></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="features-item">
                        <i class="bi bi-wallet2" style="color: #e80368;"></i>
                        <h3><a href="#">30% Hemat Biaya</a></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="features-item">
                        <i class="bi bi-arrow-up-circle" style="color: #29cc61;"></i>
                        <h3><a href="#">40% Produktivitas</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Features Section -->

    <!-- Call to Action -->
    @include('partials.cta')

    <!-- FAQ Section -->
    @include('partials.faq')

@endsection
