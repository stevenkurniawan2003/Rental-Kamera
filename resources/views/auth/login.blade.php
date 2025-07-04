<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Camera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght">
    <style>:root {
    --primary-color: #4361ee;
    --secondary-color: #3f37c9;
    --accent-color: #4895ef;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --error-color: #dc3545;
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-container {
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.login-container:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.logo-container {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 10;
}

.logo-container img {
    height: 40px;
    transition: transform 0.3s ease;
    border-radius: 6px;
}

.logo-container img:hover {
    transform: scale(1.05);
}

.login-header {
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 25px;
    text-align: center;
    position: relative;
    overflow: hidden;
    padding-top: 60px; /* Memberi ruang untuk logo */
}

.login-header h2 {
    font-weight: 600;
    margin: 0;
    position: relative;
    z-index: 1;
    font-size: 1.8rem;
}

.login-header::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    transform: rotate(30deg);
}

.login-body {
    padding: 30px;
}

.form-label {
    font-weight: 500;
    color: var(--dark-color);
    margin-bottom: 10px;
    display: block;
}

.input-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.input-group-text {
    background-color: var(--light-color);
    border-right: none;
    min-width: 45px;
    justify-content: center;
}

.form-control {
    border-left: none;
    padding-left: 15px;
    transition: all 0.3s ease;
    height: 50px;
    font-size: 1rem;
}

.form-control:focus {
    box-shadow: none;
    border-color: #ced4da;
}

.form-control:focus + .input-group-text {
    border-color: #ced4da;
}

.btn-login {
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    border: none;
    color: white;
    width: 100%;
    padding: 14px;
    font-weight: 500;
    border-radius: 8px;
    transition: all 0.3s ease;
    margin-top: 10px;
    font-size: 1.1rem;
}

.btn-login:hover {
    background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
}

.btn-login:active {
    transform: translateY(0);
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #6c757d;
    z-index: 5;
    font-size: 1.1rem;
}

.register-link {
    color: var(--primary-color);
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.register-link:hover {
    color: var(--secondary-color);
    text-decoration: underline;
}

.alert-danger {
    background-color: #f8d7da;
    color: var(--error-color);
    padding: 12px 15px;
    margin-bottom: 20px;
    border: 1px solid #f5c6cb;
    border-radius: 8px;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}

.alert-danger i {
    margin-right: 10px;
    font-size: 1.1rem;
}

@media (max-width: 576px) {
    .login-container {
        max-width: 95%;
        border-radius: 10px;
    }

    .login-body {
        padding: 25px;
    }

    body {
        padding: 15px;
    }
}
</style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <a href="{{ route('landingpage') }}" title="Kembali ke Beranda">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Rental Camera">
            </a>
        </div>

        <div class="login-header">
            <h2><i class="fas fa-camera me-2"></i> LOGIN</h2>
        </div>

        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="contoh@gmail.com" required>
                    </div>
                </div>

                <div class="mb-4 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                </button>

                <div class="mt-4 text-center">
                    Belum punya akun? <a href="{{ route('register') }}" class="register-link">Daftar disini</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
