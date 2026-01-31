@extends('layouts.layout')

@section('title', 'Contact Us - EkspImpor')
@section('body_class', 'contact-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Hubungi kami untuk konsultasi dan pertanyaan seputar layanan ekspor-impor</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Contact</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Alamat</h3>
                        <p>Jl. Sudirman No. 123, Jakarta Pusat 10220, Indonesia</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>Telepon</h3>
                        <p>+62 21 1234 5678</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>Email</h3>
                        <p>info@ekspimpor.com</p>
                    </div>
                </div>
            </div>

            <div class="row gy-4 mt-1">
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6663151846055!2d106.82497!3d-6.1754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f42ea35c4f55%3A0x7694e27c5e649e92!2sJl.%20Jenderal%20Sudirman%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1234567890" frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-lg-6">
                    <form action="{{ url('/contact') }}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="400">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subjek" required>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required></textarea>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

@endsection
