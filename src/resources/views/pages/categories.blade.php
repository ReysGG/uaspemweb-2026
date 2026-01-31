@extends('layouts.layout')

@section('title', 'Kategori Produk - EkspImpor')
@section('body_class', 'categories-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
        <div class="container">
            <h1>Kategori Produk</h1>
            <p>Kategori produk ekspor-impor kami</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Categories</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Categories Section -->
    <section id="categories" class="services section">
        <div class="container section-title" data-aos="fade-up">
            <span>Kategori</span>
            <h2>Kategori Produk</h2>
            <p>Data diambil dari API: <code>/api/v1/categories</code></p>
        </div>

        <div class="container">
            <!-- Loading State -->
            <div id="loading" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Mengambil data kategori...</p>
            </div>

            <!-- Error State -->
            <div id="error" class="alert alert-danger d-none" role="alert">
                <i class="bi bi-exclamation-triangle"></i> <span id="error-message">Gagal mengambil data kategori.</span>
            </div>

            <!-- Categories Grid -->
            <div id="categories-grid" class="row gy-4 d-none">
                <!-- Categories will be loaded here via JavaScript -->
            </div>
        </div>
    </section><!-- End Categories Section -->

    <!-- Call to Action -->
    @include('partials.cta')

    <script>
    (function() {
        const loadingEl = document.getElementById('loading');
        const errorEl = document.getElementById('error');
        const errorMsgEl = document.getElementById('error-message');
        const gridEl = document.getElementById('categories-grid');
        
        // API URL
        const apiUrl = '{{ url("/api/v1/categories") }}';
        
        console.log('Fetching categories from:', apiUrl);

        // Fetch categories from API
        fetch(apiUrl, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error('HTTP error! status: ' + response.status);
            }
            return response.json();
        })
        .then(result => {
            console.log('API Result:', result);
            loadingEl.classList.add('d-none');
            
            if (result.success && result.data) {
                const categories = result.data;
                
                if (!Array.isArray(categories) || categories.length === 0) {
                    gridEl.innerHTML = '<div class="col-12 text-center"><p class="text-muted">Tidak ada kategori tersedia.</p></div>';
                } else {
                    // Render categories
                    let html = '';
                    const icons = ['bi-box-seam', 'bi-truck', 'bi-globe', 'bi-building', 'bi-gear', 'bi-cup-hot'];
                    const productsUrl = '{{ url("/products") }}';
                    
                    categories.forEach(function(category, index) {
                        const icon = icons[index % icons.length];
                        const productCount = category.products_count || 0;
                        const categoryLink = productsUrl + '?category=' + category.id;
                        
                        html += `
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="${index * 100}">
                                <div class="service-item position-relative">
                                    <div class="icon">
                                        <i class="bi ${icon}"></i>
                                    </div>
                                    <h3><a href="${categoryLink}">${category.name}</a></h3>
                                    <p>${category.description || 'Kategori produk ekspor-impor'}</p>
                                    <div class="mt-3">
                                        <span class="badge bg-secondary">${productCount} Produk</span>
                                        <a href="${categoryLink}" class="btn btn-sm btn-primary ms-2">Lihat Produk →</a>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    gridEl.innerHTML = html;
                }
                
                gridEl.classList.remove('d-none');
            } else {
                throw new Error('Invalid response format');
            }
        })
        .catch(error => {
            console.error('Error fetching categories:', error);
            loadingEl.classList.add('d-none');
            errorMsgEl.textContent = 'Gagal mengambil data: ' + error.message;
            errorEl.classList.remove('d-none');
        });
    })();
    </script>

@endsection
