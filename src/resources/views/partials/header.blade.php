<header id="header" class="header d-flex align-items-center fixed-top {{ request()->is('/') ? '' : 'scrolled' }}">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EkspImpor</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
          <li><a href="{{ url('/services') }}" class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>
          <li><a href="{{ url('/products') }}" class="{{ request()->is('products') ? 'active' : '' }}">Products</a></li>
          <li><a href="{{ url('/categories') }}" class="{{ request()->is('categories') ? 'active' : '' }}">Categories</a></li>
          <li><a href="{{ url('/pricing') }}" class="{{ request()->is('pricing') ? 'active' : '' }}">Pricing</a></li>
          <li><a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      @auth
        <a class="btn-getstarted" href="{{ url('/admin') }}">Dashboard</a>
      @else
        <a class="btn-getstarted" href="{{ url('/admin/login') }}">Login</a>
      @endauth

    </div>
  </header>
