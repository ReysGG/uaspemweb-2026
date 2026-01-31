@extends('layouts.layout')

@section('title', 'Get a Quote - EkspImpor')
@section('body_class', 'get-quote-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
        <div class="container">
            <h1>Get a Quote</h1>
            <p>Dapatkan penawaran harga terbaik untuk kebutuhan ekspor-impor Anda</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Get a Quote</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Quote Form Section -->
    <section id="get-a-quote" class="get-a-quote section">
        <div class="container">
            <div class="row g-0" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-5 quote-bg" style="background-image: url({{ asset('assets/img/quote-bg.jpg') }});"></div>
                <div class="col-lg-7">
                    <form action="{{ url('/get-a-quote') }}" method="post" class="php-email-form">
                        @csrf
                        <h3>Request a Quote</h3>
                        <p>Silakan isi form berikut untuk mendapatkan penawaran harga.</p>

                        <div class="row gy-4">
                            <div class="col-lg-12">
                                <h4>Kebutuhan Layanan</h4>
                            </div>

                            <div class="col-md-12">
                                <select name="service" class="form-control" required>
                                    <option value="">Pilih Layanan</option>
                                    <option value="basic">Paket Basic - Rp 5.000.000/bulan</option>
                                    <option value="business">Paket Business - Rp 15.000.000/bulan</option>
                                    <option value="enterprise">Paket Enterprise - Rp 50.000.000/bulan</option>
                                    <option value="custom">Custom Solution</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <input type="number" name="users" class="form-control" placeholder="Jumlah User" min="1">
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="products" class="form-control" placeholder="Estimasi Jumlah Produk" min="1">
                            </div>

                            <div class="col-lg-12">
                                <h4>Informasi Kontak</h4>
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="company" class="form-control" placeholder="Nama Perusahaan">
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" required>
                            </div>
                            <div class="col-md-12">
                                <textarea name="message" class="form-control" rows="5" placeholder="Keterangan Tambahan (Volume transaksi, fitur khusus yang dibutuhkan, dll.)"></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit">Request Quote</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Quote Form Section -->

@endsection
