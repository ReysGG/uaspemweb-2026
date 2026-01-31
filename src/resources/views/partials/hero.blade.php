<section id="hero" class="hero section dark-background">

    <img src="{{ asset('assets/img/world-dotted-map.png') }}" alt="" class="hero-bg" data-aos="fade-in">

    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h2 data-aos="fade-up">Otomasi Invoice & Pelacakan Penjualan Ekspor-Impor</h2>
          <p data-aos="fade-up" data-aos-delay="100">Aplikasi web untuk mengotomasi proses bisnis perusahaan ekspor-impor. Pembuatan invoice otomatis, pelacakan penjualan real-time, manajemen produk & mitra, serta generasi laporan bisnis instan.</p>

          <form action="{{ url('/get-a-quote') }}" method="get" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
            <input type="text" name="search" class="form-control" placeholder="Cari produk atau layanan...">
            <button type="submit" class="btn btn-primary">Cari</button>
          </form>

          <div class="row gy-4" data-aos="fade-up" data-aos-delay="300">

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="95" data-purecounter-duration="1" class="purecounter">95</span>
                <p>% Error Berkurang</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter">15</span>
                <p>Menit/Invoice</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1" class="purecounter">30</span>
                <p>% Hemat Biaya</p>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="40" data-purecounter-duration="1" class="purecounter">40</span>
                <p>% Produktivitas</p>
              </div>
            </div><!-- End Stats Item -->

          </div>

        </div>

        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <img src="{{ asset('assets/img/hero-img.svg') }}" class="img-fluid mb-3 mb-lg-0" alt="">
        </div>

      </div>
    </div>

  </section><!-- /Hero Section -->
