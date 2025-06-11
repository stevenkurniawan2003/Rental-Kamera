<footer class="bg-dark text-white py-5">
  <div class="container">
    <div class="row">
      <!-- Logo dan Deskripsi -->
      <div class="col-lg-4 mb-4">
        <a href="{{ route('landingpage') }}" class="d-flex align-items-center mb-3 text-decoration-none">
          <img src="{{ asset('images/logo.png') }}" alt="Logo" height="40" class="me-2">
          <span class="fs-5 fw-bold text-white">Camera Rental</span>
        </a>
        <p class="text-light">Solusi terbaik untuk kebutuhan sewa kamera profesional dan aksesoris fotografi dengan harga terjangkau.</p>
        <div class="social-icons mt-3">
          <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white"><i class="fab fa-whatsapp"></i></a>
        </div>
      </div>

      <!-- Menu Cepat -->
      <div class="col-lg-2 col-md-4 mb-4">
        <h5 class="fw-bold mb-4 text-white">Menu Cepat</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ route('landingpage') }}" class="text-decoration-none text-light">Beranda</a></li>
          <li class="mb-2"><a href="#products" class="text-decoration-none text-light">Katalog</a></li>
          <li class="mb-2"><a href="#contact" class="text-decoration-none text-light">Kontak</a></li>
          <li class="mb-2"><a href="{{ route('login') }}" class="text-decoration-none text-light">Login</a></li>
          <li><a href="{{ route('register') }}" class="text-decoration-none text-light">Register</a></li>
        </ul>
      </div>

      <!-- Kontak -->
      <div class="col-lg-3 col-md-4 mb-4">
        <h5 class="fw-bold mb-4 text-white">Hubungi Kami</h5>
        <ul class="list-unstyled text-light">
          <li class="mb-3 d-flex">
            <i class="fas fa-map-marker-alt me-3 mt-1 text-primary"></i>
            <span>Jl. Kalimantan No. 333, Jember, Jawa Timur, Indonesia</span>
          </li>
          <li class="mb-3 d-flex">
            <i class="fas fa-phone-alt me-3 mt-1 text-primary"></i>
            <span>+62 812-3456-7890</span>
          </li>
          <li class="d-flex">
            <i class="fas fa-envelope me-3 mt-1 text-primary"></i>
            <span>pwebkel9@gmail.com</span>
          </li>
        </ul>
      </div>

      <!-- Jam Operasional -->
      <div class="col-lg-3 col-md-4 mb-4">
        <h5 class="fw-bold mb-4 text-white">Jam Operasional</h5>
        <ul class="list-unstyled text-light">
          <li class="mb-2 d-flex justify-content-between">
            <span>Senin - Jumat</span>
            <span class="fw-medium">09:00 - 18:00</span>
          </li>
          <li class="mb-2 d-flex justify-content-between">
            <span>Sabtu</span>
            <span class="fw-medium">10:00 - 15:00</span>
          </li>
          <li class="d-flex justify-content-between">
            <span>Minggu</span>
            <span class="fw-medium">Tutup</span>
          </li>
        </ul>
      </div>
    </div>

    <hr class="my-4 bg-secondary">

    <div class="row">
      <div class="col-md-6 text-center text-md-start">
        <p class="text-light mb-0">&copy; 2025 Camera Rental. All rights reserved.</p>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <ul class="list-inline mb-0">
          <li class="list-inline-item"><a href="#" class="text-decoration-none text-light">Terms of Service</a></li>
          <li class="list-inline-item"><span class="mx-2 text-light">•</span></li>
          <li class="list-inline-item"><a href="#" class="text-decoration-none text-light">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
