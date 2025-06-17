<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Penyewaan Kamera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .checkout-container {
            max-width: 1200px;
            margin: 30px auto;
        }
        .product-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .product-image {
            height: 150px;
            object-fit: cover;
        }
        .summary-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            position: sticky;
            top: 20px;
        }
        .btn-checkout {
            background-color: #4e73df;
            color: white;
            font-weight: 600;
            padding: 10px;
        }
        .btn-checkout:hover {
            background-color: #3a5ccc;
            color: white;
        }
        .btn-checkout:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #4e73df;
        }
        .form-label {
            font-weight: 500;
        }
        .product-item {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .product-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .loading {
            display: none;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container checkout-container">
        <a href="{{ route('keranjang')}}" class="btn btn-outline-secondary back-button mb-2">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
        <h2 class="mb-4">Checkout Penyewaan</h2>

        <!-- Alert untuk error/success -->
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            <!-- Kolom Kiri - Formulir dan Produk -->
            <div class="col-lg-8 mb-4">
                <div class="card product-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Detail Penyewa</h5>
                        
                        <!-- FORM DENGAN ACTION DAN METHOD YANG BENAR -->
                        <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST" novalidate>
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama" 
                                           value="{{ old('nama', auth()->user()->name ?? '') }}" required>
                                    <div class="error-message" id="error-nama"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                    <div class="error-message" id="error-email"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="telepon" name="telepon" 
                                           value="{{ old('telepon') }}" required>
                                    <div class="error-message" id="error-telepon"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ktp" class="form-label">Nomor KTP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ktp" name="ktp" 
                                           value="{{ old('ktp') }}" required minlength="16" maxlength="16">
                                    <div class="error-message" id="error-ktp"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" 
                                          required>{{ old('alamat') }}</textarea>
                                <div class="error-message" id="error-alamat"></div>
                            </div>

                            <!-- HIDDEN FIELDS UNTUK TANGGAL -->
                            @if($cartItems->count() > 0)
                                @php $firstItem = $cartItems->first(); @endphp
                                <input type="hidden" name="tanggal_sewa" 
                                       value="{{ \Carbon\Carbon::parse($firstItem->tanggal_mulai)->format('Y-m-d') }}">
                                <input type="hidden" name="tanggal_kembali" 
                                       value="{{ \Carbon\Carbon::parse($firstItem->tanggal_selesai)->format('Y-m-d') }}">
                            @endif

                            <!-- SECTION UNTUK MENAMPILKAN TANGGAL -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h6 class="card-title">Detail Penyewaan</h6>
                                    @if($cartItems->count() > 0)
                                        @php $firstItem = $cartItems->first(); @endphp
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Tanggal Sewa:</strong> 
                                                {{ \Carbon\Carbon::parse($firstItem->tanggal_mulai)->format('d/m/Y') }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>Tanggal Kembali:</strong> 
                                                {{ \Carbon\Carbon::parse($firstItem->tanggal_selesai)->format('d/m/Y') }}
                                            </div>
                                        </div>
                                        <div class="alert alert-info mt-2">
                                            <small><i class="fas fa-info-circle me-1"></i>
                                            Tanggal penyewaan sudah ditentukan saat menambah ke keranjang.
                                            </small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="2" 
                                          placeholder="Tambahkan catatan khusus untuk penyewaan ini...">{{ old('catatan') }}</textarea>
                            </div>

                            <!-- METODE PEMBAYARAN -->
                            <div class="mb-3">
                                <h6>Metode Pembayaran <span class="text-danger">*</span></h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="metode_pembayaran" 
                                           id="qris" value="qris" {{ old('metode_pembayaran') == 'qris' ? 'checked' : 'checked' }}>
                                    <label class="form-check-label" for="qris">
                                        <i class="fas fa-qrcode me-2"></i>QRIS
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="metode_pembayaran" 
                                           id="cod" value="cod" {{ old('metode_pembayaran') == 'cod' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cod">
                                        <i class="fas fa-money-bill-wave me-2"></i>Bayar di Tempat (COD)
                                    </label>
                                </div>
                                <div class="error-message" id="error-metode"></div>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- PRODUK YANG DISEWA -->
                <div class="card product-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Produk yang Disewa</h5>

                        @foreach($cartItems as $item)
                        <div class="product-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/produk/' . $item->produk->gambar) }}" 
                                         class="img-fluid rounded product-image" alt="{{ $item->produk->nama }}">
                                </div>
                                <div class="col-md-9">
                                    <h6>{{ $item->produk->nama }}</h6>
                                    <p class="text-muted small mb-1">{{ $item->produk->kategori }}</p>
                                    <p class="mb-1">Rp{{ number_format($item->produk->harga, 0, ',', '.') }}/hari</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Jumlah: {{ $item->jumlah }} × Durasi: {{ $item->durasi }} hari</span>
                                        <span class="fw-bold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            Tanggal: {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }} - 
                                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

            <!-- Kolom Kanan - Ringkasan Pembayaran -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="section-title">Ringkasan Pembayaran</h5>

                    @foreach($cartItems as $item)
                    <div class="mb-3">
                        <h6 class="mb-1">{{ $item->produk->nama }}</h6>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small text-muted">{{ $item->jumlah }} unit × {{ $item->durasi }} hari</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small text-muted">Rp{{ number_format($item->produk->harga, 0, ',', '.') }}/hari</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold">Subtotal</span>
                            <span class="fw-bold text-primary">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @if(!$loop->last)<hr>@endif
                    @endforeach

                    <hr class="mt-3">
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total Pembayaran</span>
                        <span class="text-success">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <button type="button" id="submitBtn" class="btn btn-checkout w-100 mt-3">
                        <span class="loading">
                            <i class="fas fa-spinner fa-spin me-2"></i>Processing...
                        </span>
                        <span class="normal">
                            <i class="fas fa-credit-card me-2"></i>Lanjutkan Pembayaran
                        </span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('checkoutForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // Fungsi untuk clear error messages
            function clearErrors() {
                document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));
            }

            // Fungsi untuk show error
            function showError(fieldName, message) {
                const errorEl = document.getElementById(`error-${fieldName}`);
                const inputEl = document.getElementById(fieldName);
                if (errorEl) errorEl.textContent = message;
                if (inputEl) inputEl.classList.add('is-invalid');
            }

            // Fungsi validasi
            function validateForm() {
                clearErrors();
                let isValid = true;

                // Validasi nama
                const nama = document.getElementById('nama').value.trim();
                if (!nama) {
                    showError('nama', 'Nama lengkap harus diisi');
                    isValid = false;
                }

                // Validasi email
                const email = document.getElementById('email').value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) {
                    showError('email', 'Email harus diisi');
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    showError('email', 'Format email tidak valid');
                    isValid = false;
                }

                // Validasi telepon
                const telepon = document.getElementById('telepon').value.trim();
                if (!telepon) {
                    showError('telepon', 'Nomor telepon harus diisi');
                    isValid = false;
                }

                // Validasi KTP
                const ktp = document.getElementById('ktp').value.trim();
                if (!ktp) {
                    showError('ktp', 'Nomor KTP harus diisi');
                    isValid = false;
                } else if (ktp.length !== 16) {
                    showError('ktp', 'Nomor KTP harus 16 digit');
                    isValid = false;
                }

                // Validasi alamat
                const alamat = document.getElementById('alamat').value.trim();
                if (!alamat) {
                    showError('alamat', 'Alamat lengkap harus diisi');
                    isValid = false;
                }

                // Validasi metode pembayaran
                const metodePembayaran = document.querySelector('input[name="metode_pembayaran"]:checked');
                if (!metodePembayaran) {
                    showError('metode', 'Pilih metode pembayaran');
                    isValid = false;
                }

                return isValid;
            }

            // Event listener untuk submit button
            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                console.log('Submit button clicked'); // Debug log
                
                if (validateForm()) {
                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.querySelector('.loading').style.display = 'inline';
                    submitBtn.querySelector('.normal').style.display = 'none';
                    
                    console.log('Form validation passed, submitting...'); // Debug log
                    
                    // Submit form
                    form.submit();
                } else {
                    console.log('Form validation failed'); // Debug log
                }
            });

            // Prevent default form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log('Form submit event triggered'); // Debug log
            });

            // Auto-scroll to top on page load
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>