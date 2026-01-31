@extends('layouts.layout')

@section('title', 'About Us - EkspImpor')
@section('body_class', 'about-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
        <div class="container">
            <h1>About Us</h1>
            <p>Solusi ekspor-impor terpercaya untuk bisnis Anda. Dengan pengalaman bertahun-tahun di industri logistik, kami menyediakan layanan berkualitas tinggi untuk memenuhi kebutuhan distribusi global Anda.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">About Us</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('assets/img/about.jpg') }}" class="img-fluid" alt="About EkspImpor">
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Tentang Kami</h3>
                    <p class="fst-italic">
                        EkspImpor adalah perusahaan yang bergerak di bidang ekspor-impor, menyediakan solusi komprehensif untuk kebutuhan bisnis Anda.
                    </p>
                    <ul>
                        <li><i class="bi bi-check2-all"></i> <span>Pengalaman lebih dari 10 tahun dalam industri ekspor-impor</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Jaringan logistik global ke lebih dari 100 negara</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Tim ahli bea cukai dan kepabeanan bersertifikat</span></li>
                        <li><i class="bi bi-check2-all"></i> <span>Sistem tracking real-time untuk setiap pengiriman</span></li>
                    </ul>
                    <p>
                        Kami berkomitmen untuk memberikan layanan terbaik dengan harga kompetitif. Dengan teknologi terkini dan tim profesional, kami memastikan setiap pengiriman Anda sampai tepat waktu dan aman.
                    </p>
                </div>
            </div>
        </div>
    </section><!-- End About Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section light-background">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-box">
                        <h3>Mengapa Memilih Kami?</h3>
                        <p>Kami mengotomasi proses bisnis ekspor-impor Anda dengan fokus pada efisiensi dan akurasi. Pengurangan waktu proses dari 2 jam menjadi 15 menit per transaksi.</p>
                        <div class="text-center">
                            <a href="{{ url('/services') }}" class="more-btn"><span>Lihat Layanan</span> <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-xl-4">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-clipboard-data"></i>
                                <h4>Otomasi Invoice</h4>
                                <p>Kurangi kesalahan manual sebesar 95% dengan sistem invoice otomatis</p>
                            </div>
                        </div>
                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Pelacakan Real-Time</h4>
                                <p>Monitor status penjualan dari quotation hingga delivered</p>
                            </div>
                        </div>
                        <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                <i class="bi bi-graph-up-arrow"></i>
                                <h4>Laporan Instan</h4>
                                <p>Akses laporan bisnis real-time untuk pengambilan keputusan cepat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Why Us Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="95" data-purecounter-duration="1" class="purecounter"></span>
                        <p>% Error Berkurang</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                        <p>Menit/Invoice</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1" class="purecounter"></span>
                        <p>% Hemat Biaya</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="40" data-purecounter-duration="1" class="purecounter"></span>
                        <p>% Produktivitas</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Stats Section -->

    <!-- Team Section -->
    <section id="team" class="team section light-background">
        <div class="container section-title" data-aos="fade-up">
            <span>Our Team</span>
            <h2>Tim Profesional Kami</h2>
            <p>Tim berdedikasi yang siap membantu kebutuhan ekspor-impor Anda</p>
        </div>
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img">
                        <img src="{{ asset('assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="member-info text-center">
                        <h4>Direktur Utama</h4>
                        <span>Chief Executive Officer</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="200">
                    <div class="member-img">
                        <img src="{{ asset('assets/img/team/team-2.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="member-info text-center">
                        <h4>Operations Manager</h4>
                        <span>Head of Operations</span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="300">
                    <div class="member-img">
                        <img src="{{ asset('assets/img/team/team-3.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="member-info text-center">
                        <h4>Sales Manager</h4>
                        <span>Head of Sales</span>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Team Section -->

    <!-- Call to Action -->
    @include('partials.cta')

@endsection
