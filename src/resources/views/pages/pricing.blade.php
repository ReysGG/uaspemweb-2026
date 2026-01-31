@extends('layouts.layout')

@section('title', 'Pricing - EkspImpor')
@section('body_class', 'pricing-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
        <div class="container">
            <h1>Pricing Plans</h1>
            <p>Pilih paket yang sesuai dengan kebutuhan bisnis ekspor-impor Anda</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Pricing</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">
        <div class="container section-title" data-aos="fade-up">
            <span>Harga</span>
            <h2>Paket Layanan</h2>
            <p>Transparansi harga untuk setiap layanan kami</p>
        </div>
        <div class="container" data-aos="zoom-in" data-aos-delay="100">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="pricing-item">
                        <h3>Basic</h3>
                        <div class="icon"><i class="bi bi-box"></i></div>
                        <h4><sup>Rp</sup>5.000.000<span> / bulan</span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Manajemen Produk</span></li>
                            <li><i class="bi bi-check"></i> <span>Invoice Otomatis</span></li>
                            <li><i class="bi bi-check"></i> <span>Pelacakan Penjualan</span></li>
                            <li><i class="bi bi-check"></i> <span>Laporan Dasar</span></li>
                            <li class="na"><i class="bi bi-x"></i> <span>Multi-User Access</span></li>
                            <li class="na"><i class="bi bi-x"></i> <span>API Integration</span></li>
                        </ul>
                        <a href="{{ url('/get-a-quote') }}" class="buy-btn">Mulai Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pricing-item featured">
                        <p class="popular">Popular</p>
                        <h3>Business</h3>
                        <div class="icon"><i class="bi bi-rocket"></i></div>
                        <h4><sup>Rp</sup>15.000.000<span> / bulan</span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Semua Fitur Basic</span></li>
                            <li><i class="bi bi-check"></i> <span>Multi-User (5 akun)</span></li>
                            <li><i class="bi bi-check"></i> <span>Role-Based Access</span></li>
                            <li><i class="bi bi-check"></i> <span>Dashboard Lengkap</span></li>
                            <li><i class="bi bi-check"></i> <span>Laporan Analitik</span></li>
                            <li class="na"><i class="bi bi-x"></i> <span>API Integration</span></li>
                        </ul>
                        <a href="{{ url('/get-a-quote') }}" class="buy-btn">Mulai Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="pricing-item">
                        <h3>Enterprise</h3>
                        <div class="icon"><i class="bi bi-building"></i></div>
                        <h4><sup>Rp</sup>50.000.000<span> / bulan</span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Semua Fitur Business</span></li>
                            <li><i class="bi bi-check"></i> <span>Unlimited Users</span></li>
                            <li><i class="bi bi-check"></i> <span>API Integration</span></li>
                            <li><i class="bi bi-check"></i> <span>Custom Development</span></li>
                            <li><i class="bi bi-check"></i> <span>Priority Support 24/7</span></li>
                            <li><i class="bi bi-check"></i> <span>Dedicated Account Manager</span></li>
                        </ul>
                        <a href="{{ url('/get-a-quote') }}" class="buy-btn">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Pricing Section -->

    <!-- Call to Action -->
    @include('partials.cta')

@endsection
