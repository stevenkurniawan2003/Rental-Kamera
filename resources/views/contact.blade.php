@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4 fw-bold">Hubungi Kami</h2>

    <div class="row">
      <!-- Info Kontak -->
      <div class="col-md-6 mb-4">
        <div class="bg-white shadow rounded p-4">
          <h5 class="fw-semibold">Camera Rental Store</h5>
          <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-danger"></i>Jl. Sewa Kamera No. 123, Jakarta</p>
          <p class="mb-2"><i class="fas fa-phone me-2 text-success"></i>+62 812-3456-7890</p>
          <p class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i>camerarental@example.com</p>
          <p class="mb-0"><i class="fas fa-clock me-2 text-warning"></i>Senin - Sabtu, 09.00 - 18.00</p>
        </div>
      </div>

      <!-- Google Maps -->
      <div class="col-md-6 mb-4">
        <div class="ratio ratio-4x3 rounded shadow">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.997787350425!2d106.82300707572044!3d-6.137537260373419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a1d27d676e057%3A0xcda8f4df929f86e!2sKota%20Tua%2C%20West%20Jakarta!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
    