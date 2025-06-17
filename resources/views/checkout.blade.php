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
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #4e73df;
        }
        .form-label {
            font-weight: 500;
        }
        .date-input {
            position: relative;
        }
        .date-input i {
            position: absolute;
            right: 10px;
            top: 10px;
            color: #6c757d;
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
    </style>
</head>
<body>
    <div class="container checkout-container">
        <a href="{{ route('keranjang')}}" class="btn btn-outline-secondary back-button mb-2">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
        <h2 class="mb-4">Checkout Penyewaan</h2>

        <div class="row">
            <!-- Kolom Kiri - Formulir dan Produk -->
            <div class="col-lg-8 mb-4">
                <div class="card product-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Detail Penyewa</h5>
                        <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="telepon" name="telepon" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ktp" class="form-label">Nomor KTP</label>
                                    <input type="text" class="form-control" id="ktp" name="ktp" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card product-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Detail Penyewaan</h5>
                        @if($cartItems->count() > 0)
                            @php
                                $firstItem = $cartItems->first();
                            @endphp
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                                    <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" 
                                           value="{{ $firstItem->tanggal_mulai }}" readonly>
                                    <small class="text-muted">Tanggal dari keranjang</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" 
                                           value="{{ $firstItem->tanggal_selesai }}" readonly>
                                    <small class="text-muted">Tanggal dari keranjang</small>
                                </div>
                            </div>
                            <div class="alert alert-info">
                                <small><i class="fas fa-info-circle me-1"></i>
                                Tanggal penyewaan sudah ditentukan saat menambah ke keranjang. 
                                Untuk mengubah tanggal, silakan kembali ke halaman keranjang.
                                </small>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                Keranjang kosong! Silakan tambahkan produk terlebih dahulu.
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2" 
                                      placeholder="Tambahkan catatan khusus untuk penyewaan ini..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="card product-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Produk yang Disewa</h5>

                        @foreach($cartItems as $item)
                        <div class="product-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('storage/produk/' . $item->produk->gambar) }}" class="img-fluid rounded product-image" alt="{{ $item->produk->nama }}">
                                </div>
                                <div class="col-md-9">
                                    <h6>{{ $item->produk->nama }}</h6>
                                    <p class="text-muted small mb-1">{{ $item->produk->kategori }}</p>
                                    <p class="mb-1">Rp{{ number_format($item->produk->harga, 0, ',', '.') }}/hari</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Jumlah: {{ $item->jumlah }} × Durasi: {{ $item->durasi }} hari</span>
                                        <span class="fw-bold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                    </div>
                                    <!-- Debug Info -->
                                    <div class="mt-1">
                                        <small class="text-danger">
                                            Debug: {{ $item->produk->harga }} × {{ $item->jumlah }} × {{ $item->durasi }} = {{ $item->produk->harga * $item->jumlah * $item->durasi }}
                                        </small>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            Tanggal: {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="card product-card">
                    <div class="card-body">
                        <h5 class="card-title">Metode Pembayaran</h5>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" id="qris" value="qris" checked>
                            <label class="form-check-label" for="qris">
                                <i class="fas fa-qrcode me-2"></i>QRIS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" id="cod" value="cod">
                            <label class="form-check-label" for="cod">
                                <i class="fas fa-money-bill-wave me-2"></i>Bayar di Tempat (COD)
                            </label>
                        </div>
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
                            <span class="small text-muted">{{ $item->jumlah }} × {{ $item->durasi }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small text-muted">Rp{{ number_format($item->produk->harga, 0, ',', '.') }}/hari</span>
                            <span class="small"></span>
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

                    <button type="submit" form="checkoutForm" class="btn btn-checkout w-100 mt-3">
                        <i class="fas fa-credit-card me-2"></i>Lanjutkan Pembayaran
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onload = function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            };

        document.addEventListener('DOMContentLoaded', function() {
            // Form submission
            document.getElementById('checkoutForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validasi form
                const nama = document.getElementById('nama').value;
                const email = document.getElementById('email').value;
                const telepon = document.getElementById('telepon').value;
                const ktp = document.getElementById('ktp').value;
                const alamat = document.getElementById('alamat').value;
                
                if (!nama || !email || !telepon || !ktp || !alamat) {
                    alert('Harap lengkapi semua data yang diperlukan!');
                    return;
                }

                // Validasi metode pembayaran
                const metodePembayaran = document.querySelector('input[name="metode_pembayaran"]:checked');
                if (!metodePembayaran) {
                    alert('Harap pilih metode pembayaran!');
                    return;
                }

                // Jika validasi berhasil, submit form
                this.submit();
            });
        });
    </script>
</body>
</html>