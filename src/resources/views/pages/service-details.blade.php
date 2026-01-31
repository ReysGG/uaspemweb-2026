@extends('layouts.layout')

@section('title', 'Service Details - EkspImpor')
@section('body_class', 'service-details-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
        <div class="container">
            <h1>Service Details</h1>
            <p>Detail lengkap layanan ekspor-impor kami</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/services') }}">Services</a></li>
                    <li class="current">Service Details</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-box">
                        <h4>Layanan Kami</h4>
                        <div class="services-list">
                            <a href="#otomasi-invoice" class="active"><i class="bi bi-arrow-right-circle"></i><span>Otomasi Invoice</span></a>
                            <a href="#pelacakan-realtime"><i class="bi bi-arrow-right-circle"></i><span>Pelacakan Real-Time</span></a>
                            <a href="#manajemen-produk"><i class="bi bi-arrow-right-circle"></i><span>Manajemen Produk</span></a>
                            <a href="#manajemen-mitra"><i class="bi bi-arrow-right-circle"></i><span>Manajemen Mitra</span></a>
                            <a href="#dashboard-reporting"><i class="bi bi-arrow-right-circle"></i><span>Dashboard & Reporting</span></a>
                            <a href="#role-based-access"><i class="bi bi-arrow-right-circle"></i><span>Role-Based Access</span></a>
                        </div>
                    </div>

                    <div class="service-box">
                        <h4>Unduh Brosur</h4>
                        <div class="download-catalog">
                            <a href="#"><i class="bi bi-filetype-pdf"></i><span>Katalog Produk.pdf</span></a>
                            <a href="#"><i class="bi bi-file-earmark-word"></i><span>Panduan Pengguna.docx</span></a>
                        </div>
                    </div>

                    <div class="help-box d-flex flex-column justify-content-center align-items-center">
                        <i class="bi bi-headset"></i>
                        <h4>Butuh Bantuan?</h4>
                        <p class="d-flex align-items-center mt-2 mb-0"><i class="bi bi-telephone me-2"></i> <span>+62 21 1234 5678</span></p>
                        <p class="d-flex align-items-center mt-1 mb-0"><i class="bi bi-envelope me-2"></i> <span>info@ekspimpor.com</span></p>
                    </div>
                </div>

                <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <!-- Otomasi Invoice -->
                    <section id="otomasi-invoice" class="mb-5">
                        <img src="{{ asset('assets/img/services-1.jpg') }}" alt="" class="img-fluid services-img">
                        <h3>Otomasi Invoice</h3>
                        <p>
                            Sistem otomasi invoice kami memungkinkan Anda membuat invoice profesional dalam hitungan menit. 
                            Tidak perlu lagi menghabiskan waktu berjam-jam untuk membuat dokumen manual yang rentan kesalahan.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Generate invoice otomatis dari data penjualan</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Template invoice profesional siap cetak</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Export ke PDF dengan satu klik</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Kalkulasi pajak otomatis (PPN 11%)</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Tracking status pembayaran (Draft, Sent, Paid)</span></li>
                        </ul>
                        <p>
                            <strong>Hasil:</strong> Kurangi waktu pembuatan invoice dari 2 jam menjadi hanya 15 menit per transaksi.
                        </p>
                    </section>

                    <!-- Pelacakan Real-Time -->
                    <section id="pelacakan-realtime" class="mb-5">
                        <img src="{{ asset('assets/img/services-2.jpg') }}" alt="" class="img-fluid services-img">
                        <h3>Pelacakan Real-Time</h3>
                        <p>
                            Pantau setiap transaksi penjualan dari awal hingga akhir dengan sistem pelacakan real-time. 
                            Setiap perubahan status tercatat dengan riwayat lengkap.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Status tracking: Quotation → Confirmed → Processing → Shipped → Completed</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Riwayat perubahan status lengkap</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Notifikasi perubahan status</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Estimasi waktu kedatangan (ETA)</span></li>
                        </ul>
                    </section>

                    <!-- Manajemen Produk -->
                    <section id="manajemen-produk" class="mb-5">
                        <img src="{{ asset('assets/img/services-3.jpg') }}" alt="" class="img-fluid services-img">
                        <h3>Manajemen Produk</h3>
                        <p>
                            Kelola katalog produk ekspor-impor Anda dengan fitur lengkap untuk dokumentasi dan tracking.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Input data produk lengkap (nama, deskripsi, harga)</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Kode HS untuk kepabeanan ekspor-impor</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Kategorisasi produk</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Manajemen stok</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Upload gambar produk</span></li>
                        </ul>
                    </section>

                    <!-- Manajemen Mitra -->
                    <section id="manajemen-mitra" class="mb-5">
                        <img src="{{ asset('assets/img/services-4.jpg') }}" alt="" class="img-fluid services-img">
                        <h3>Manajemen Mitra</h3>
                        <p>
                            Database relasi bisnis untuk mengelola customer dan mitra bisnis Anda dengan informasi lengkap.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Data customer lengkap (nama, perusahaan, alamat)</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Informasi kontak (email, telepon)</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Riwayat transaksi per customer</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Filter berdasarkan negara</span></li>
                        </ul>
                    </section>

                    <!-- Dashboard & Reporting -->
                    <section id="dashboard-reporting" class="mb-5">
                        <img src="{{ asset('assets/img/services-5.jpg') }}" alt="" class="img-fluid services-img">
                        <h3>Dashboard & Reporting</h3>
                        <p>
                            Visualisasi data penjualan dengan statistik lengkap untuk pengambilan keputusan bisnis.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span>Statistik penjualan real-time</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Grafik trend penjualan 6 bulan</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Top products dan customers</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Invoice pending dan overdue</span></li>
                            <li><i class="bi bi-check-circle"></i> <span>Export laporan</span></li>
                        </ul>
                    </section>

                    <!-- Role-Based Access -->
                    <section id="role-based-access">
                        <img src="{{ asset('assets/img/services-6.jpg') }}" alt="" class="img-fluid services-img">
                        <h3>Role-Based Access Control</h3>
                        <p>
                            Sistem login dengan pengaturan akses pengguna terstruktur untuk keamanan dan efisiensi.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> <span><strong>Owner:</strong> Monitoring kinerja, akses laporan strategis</span></li>
                            <li><i class="bi bi-check-circle"></i> <span><strong>Admin:</strong> Manage semua data, generate laporan lengkap</span></li>
                            <li><i class="bi bi-check-circle"></i> <span><strong>Penjual:</strong> Input penjualan, generate invoice, manage customer</span></li>
                            <li><i class="bi bi-check-circle"></i> <span><strong>Pembeli:</strong> Menerima invoice, konfirmasi pembayaran</span></li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </section><!-- End Service Details Section -->

    <!-- Call to Action -->
    @include('partials.cta')

@endsection
