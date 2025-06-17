<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
  <div class="container">
    <div class="d-flex align-items-center" style="width: 200px;">
      <a class="navbar-brand" href="{{ route('landingpage') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40">
      </a>
      <span class="ms-2 fw-semibold d-none d-lg-block" style="font-size: 1.2rem; line-height: 1;">Camera Rental</span>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item mx-lg-2">
          <a class="nav-link fw-medium px-3 py-2 rounded" href="/">Beranda</a>
        </li>
        <li class="nav-item mx-lg-2">
          <a class="nav-link fw-medium px-3 py-2 rounded" href="{{ route('kataloguser') }}">Katalog</a>
        </li>
        <li class="nav-item mx-lg-2">
          <a class="nav-link fw-medium px-3 py-2 rounded" href="#contact">Kontak</a>
        </li>
      </ul>

      <!-- Menu Kanan -->
      <ul class="navbar-nav" style="width: 200px; justify-content: flex-end;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @auth
              <i class="fas fa-user-circle me-1"></i>
            @else
              <i class="fas fa-sign-in-alt me-1"></i>
            @endauth
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            @auth
              <li><span class="dropdown-item-text fw-bold text-truncate px-3 py-2">{{ Auth::user()->name }}</span></li>
              <li><hr class="dropdown-divider m-0"></li>
              <li>
                <a class="dropdown-item d-flex align-items-center px-3 py-2" href="#">
                  <i class="fas fa-user-edit me-2"></i>Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center px-3 py-2" href="{{ route('riwayat.sewa') }}">
                  <i class="fas fa-history me-2"></i>Riwayat Sewa
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center px-3 py-2" href="{{ route('keranjang') }}">
                  <i class="fas fa-shopping-cart me-2"></i>Keranjang
                </a>
              </li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item d-flex align-items-center px-3 py-2 w-100">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                  </button>
                </form>
              </li>
            @else
              <li>
                <a class="dropdown-item d-flex align-items-center px-3 py-2" href="{{ route('login') }}">
                  <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center px-3 py-2" href="{{ route('register') }}">
                  <i class="fas fa-user-plus me-2"></i>Register
                </a>
              </li>
            @endauth
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


