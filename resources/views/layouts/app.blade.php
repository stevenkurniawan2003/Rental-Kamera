<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      padding-top: 80px; /* Diperbesar untuk mengkompensasi navbar fixed */
    }

    .navbar {
      transition: all 0.3s ease;
      padding: 0.5rem 0;
    }

    .navbar.scrolled {
      box-shadow: 0 2px 15px rgba(0,0,0,0.1);
      background-color: rgba(255,255,255,0.98) !important;
      backdrop-filter: blur(8px);
    }

    .nav-link {
      transition: all 0.2s ease;
    }

    .nav-link:hover {
      background-color: rgba(13, 110, 253, 0.1);
      color: #0d6efd !important;
    }

    .navbar-brand img {
      transition: transform 0.3s ease;
    }

    .navbar-brand:hover img {
      transform: scale(1.05);
    }
  </style>

  @yield('styles')

</head>

<body>
  @include('components.navbar')

  <main>
    @yield('content')
  </main>

  @include('components.footer')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const navbar = document.querySelector('.navbar');

      if (window.scrollY > 10) {
        navbar.classList.add('scrolled');
      }

      window.addEventListener('scroll', function() {
        if (window.scrollY > 10) {
          navbar.classList.add('scrolled');
        } else {
          navbar.classList.remove('scrolled');
        }
      });
    });
  </script>

  @stack('scripts')
</body>
</html>
