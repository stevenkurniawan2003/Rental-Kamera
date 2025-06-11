<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Rental Camera</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .register-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .register-container:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .register-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-header h2 {
            font-weight: 600;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .register-header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }

        .register-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 8px;
            display: block;
        }

        .input-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .input-group-text {
            background-color: var(--light-color);
            border-right: none;
        }

        .form-control {
            border-left: none;
            padding-left: 0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }

        .form-control:focus + .input-group-text {
            border-color: #ced4da;
        }

        .btn-register {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            width: 100%;
            padding: 12px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 5;
        }

        .login-link {
            color: var(--primary-color);
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .form-text {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }

        @media (max-width: 576px) {
            .register-container {
                border-radius: 0;
            }

            body {
                padding: 0;
                background: white;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h2><i class="fas fa-camera me-2"></i> REGISTER</h2>
        </div>
        <div class="register-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="contoh@gmail.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="mb-4 position-relative">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 8 karakter" required>
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                    <div class="form-text">Gunakan kombinasi huruf, angka, dan simbol</div>
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">Nomor Telepon/WhatsApp</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                        <input type="tel" class="form-control" id="phone" name="nomor" placeholder="0812-3456-7890" value="{{ old('nomor') }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="address" class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" id="address" rows="3" name="alamat" placeholder="Jalan, No. Rumah, RT/RW, Kecamatan, Kota">{{ old('alamat') }}</textarea>
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                </button>

                <div class="mt-4 text-center">
                    Sudah punya akun? <a href="{{ route('login') }}" class="login-link">Masuk disini</a>
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

        // Format phone number input
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 4) {
                value = value.replace(/(\d{4})(\d{4})(\d{0,4})/, '$1-$2-$3');
            } else if (value.length > 0) {
                value = value.replace(/(\d{0,4})/, '$1');
            }
            e.target.value = value;
        });
    </script>
</body>
</html>
