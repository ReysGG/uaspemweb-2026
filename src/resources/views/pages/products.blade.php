@extends('layouts.layout')

@section('title', 'Katalog Produk - EkspImpor')
@section('body_class', 'products-page')

@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade">
        <div class="container">
            <h1>Katalog Produk</h1>
            <p>Daftar produk ekspor-impor kami</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Products</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Products Section -->
    <section id="products" class="services section">
        <div class="container section-title" data-aos="fade-up">
            <span>Produk</span>
            <h2>Katalog Produk Ekspor-Impor</h2>
            <p id="api-info">Data diambil dari API: <code>/api/v1/products</code></p>
        </div>

        <div class="container">
            <!-- Filter Bar -->
            <div class="row mb-4" data-aos="fade-up">
                <div class="col-md-6">
                    <label class="form-label">Filter Kategori:</label>
                    <select id="category-filter" class="form-select">
                        <option value="">Semua Kategori</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Cari Produk:</label>
                    <input type="text" id="search-input" class="form-control" placeholder="Ketik nama produk...">
                </div>
            </div>

            <!-- Active Filter Badge -->
            <div id="active-filter" class="mb-3 d-none">
                <span class="badge bg-primary fs-6">
                    <i class="bi bi-funnel"></i> Filter: <span id="filter-name"></span>
                    <a href="{{ url('/products') }}" class="text-white ms-2"><i class="bi bi-x-circle"></i></a>
                </span>
            </div>

            <!-- Loading State -->
            <div id="loading" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Mengambil data produk...</p>
            </div>

            <!-- Error State -->
            <div id="error" class="alert alert-danger d-none" role="alert">
                <i class="bi bi-exclamation-triangle"></i> <span id="error-message">Gagal mengambil data produk.</span>
            </div>

            <!-- Products Grid -->
            <div id="products-grid" class="row gy-4 d-none">
                <!-- Products will be loaded here via JavaScript -->
            </div>

            <!-- No Results -->
            <div id="no-results" class="text-center py-5 d-none">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <p class="mt-3 text-muted">Tidak ada produk ditemukan.</p>
            </div>
        </div>
    </section><!-- End Products Section -->

    <!-- Call to Action -->
    @include('partials.cta')

    <script>
    (function() {
        const loadingEl = document.getElementById('loading');
        const errorEl = document.getElementById('error');
        const errorMsgEl = document.getElementById('error-message');
        const gridEl = document.getElementById('products-grid');
        const noResultsEl = document.getElementById('no-results');
        const categoryFilter = document.getElementById('category-filter');
        const searchInput = document.getElementById('search-input');
        const activeFilterEl = document.getElementById('active-filter');
        const filterNameEl = document.getElementById('filter-name');
        const apiInfoEl = document.getElementById('api-info');
        
        // Get category from URL
        const urlParams = new URLSearchParams(window.location.search);
        const categoryId = urlParams.get('category');
        
        // Base API URLs
        const productsApiUrl = '{{ url("/api/v1/products") }}';
        const categoriesApiUrl = '{{ url("/api/v1/categories") }}';
        
        // Load categories for filter dropdown
        fetch(categoriesApiUrl, {
            headers: { 'Accept': 'application/json' }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success && result.data) {
                result.data.forEach(function(category) {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name + ' (' + (category.products_count || 0) + ')';
                    if (categoryId && categoryId == category.id) {
                        option.selected = true;
                        filterNameEl.textContent = category.name;
                        activeFilterEl.classList.remove('d-none');
                    }
                    categoryFilter.appendChild(option);
                });
            }
        });
        
        // Load products function
        function loadProducts() {
            loadingEl.classList.remove('d-none');
            gridEl.classList.add('d-none');
            noResultsEl.classList.add('d-none');
            errorEl.classList.add('d-none');
            
            // Build API URL with filters
            let apiUrl = productsApiUrl;
            const params = new URLSearchParams();
            
            const selectedCategory = categoryFilter.value;
            const searchTerm = searchInput.value.trim();
            
            if (selectedCategory) {
                params.append('category_id', selectedCategory);
            }
            if (searchTerm) {
                params.append('search', searchTerm);
            }
            
            if (params.toString()) {
                apiUrl += '?' + params.toString();
            }
            
            apiInfoEl.innerHTML = 'Data diambil dari API: <code>' + apiUrl.replace('{{ url("") }}', '') + '</code>';
            
            console.log('Fetching products from:', apiUrl);

            fetch(apiUrl, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('HTTP error! status: ' + response.status);
                }
                return response.json();
            })
            .then(result => {
                loadingEl.classList.add('d-none');
                
                if (result.success && result.data) {
                    const products = result.data.data || result.data;
                    
                    if (!Array.isArray(products) || products.length === 0) {
                        noResultsEl.classList.remove('d-none');
                    } else {
                        let html = '';
                        products.forEach(function(product) {
                            const price = Number(product.price).toLocaleString('id-ID');
                            const stockBadge = product.stock > 0 
                                ? '<span class="badge bg-success ms-2">Stok: ' + product.stock + '</span>'
                                : '<span class="badge bg-danger ms-2">Habis</span>';
                            const categoryName = product.category ? product.category.name : 'Uncategorized';
                            const hsCode = product.hs_code ? '<br><i class="bi bi-upc"></i> HS: ' + product.hs_code : '';
                            
                            html += `
                                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                                    <div class="service-item position-relative">
                                        <div class="icon">
                                            <i class="bi bi-box-seam"></i>
                                        </div>
                                        <h3>${product.name}</h3>
                                        <p>${product.description || 'Tidak ada deskripsi'}</p>
                                        <div class="mt-3">
                                            <span class="badge bg-primary fs-6">Rp ${price}</span>
                                            ${stockBadge}
                                        </div>
                                        <p class="mt-2 text-muted small">
                                            <i class="bi bi-tag"></i> ${categoryName}
                                            ${hsCode}
                                        </p>
                                    </div>
                                </div>
                            `;
                        });
                        gridEl.innerHTML = html;
                        gridEl.classList.remove('d-none');
                    }
                } else {
                    throw new Error('Invalid response format');
                }
            })
            .catch(error => {
                console.error('Error fetching products:', error);
                loadingEl.classList.add('d-none');
                errorMsgEl.textContent = 'Gagal mengambil data: ' + error.message;
                errorEl.classList.remove('d-none');
            });
        }
        
        // Event listeners
        categoryFilter.addEventListener('change', function() {
            // Update URL
            const url = new URL(window.location.href);
            if (this.value) {
                url.searchParams.set('category', this.value);
                filterNameEl.textContent = this.options[this.selectedIndex].text;
                activeFilterEl.classList.remove('d-none');
            } else {
                url.searchParams.delete('category');
                activeFilterEl.classList.add('d-none');
            }
            window.history.pushState({}, '', url);
            loadProducts();
        });
        
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(loadProducts, 500); // Debounce 500ms
        });
        
        // Initial load
        loadProducts();
    })();
    </script>

@endsection
