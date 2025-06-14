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
                        <form id="checkoutForm">
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
                        <div class="row">
                            <div class="col-md-6 mb-3 date-input">
                                <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                                <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" required>

                            </div>
                            <div class="col-md-6 mb-3 date-input">
                                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
                              
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card product-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Produk yang Disewa</h5>

                        <div class="product-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('images/mirrorless.jpg') }}" class="img-fluid rounded product-image" alt="Canon EOS R5">
                                </div>
                                <div class="col-md-9">
                                    <h6>Canon EOS R5</h6>
                                    <p class="text-muted small mb-1">Kamera Mirrorless</p>
                                    <p class="mb-1">Rp 250.000/hari</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Durasi: <span class="jumlah-hari">3</span> hari</span>
                                        <span class="fw-bold">Rp 750.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('images/dslr-camera.jpg') }}" class="img-fluid rounded product-image" alt="Canon EOS R5">
                                </div>
                                <div class="col-md-9">
                                    <h6>Canon DSLR</h6>
                                    <p class="text-muted small mb-1">Kamera DSLR</p>
                                    <p class="mb-1">Rp 350.000/hari</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Durasi: <span class="jumlah-hari">1</span> hari</span>
                                        <span class="fw-bold">Rp 350.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card product-card">
                    <div class="card-body">
                        <h5 class="card-title">Metode Pembayaran</h5>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" id="qris" value="qris" checked>
                            <label class="form-check-label" for="qris">
                                QRIS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" id="cod" value="cod">
                            <label class="form-check-label" for="cod">
                                Bayar di Tempat (COD)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan - Ringkasan Pembayaran -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="section-title">Ringkasan Pembayaran</h5>

                    <div class="mb-3">
                        <h6 class="mb-3">Canon EOS R5</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal (<span id="total-hari">3</span> hari)</span>
                            <span id="subtotal">Rp 750.000</span>
                        </div>
                        <hr>
                         <h6 class="mb-3">Canon DSLR</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal (<span id="total-hari">1</span> hari)</span>
                            <span id="subtotal">Rp 350.000</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total Pembayaran</span>
                            <span id="total-pembayaran">Rp 1.100.000</span>
                        </div>
                    </div>
                    <button type="submit" form="checkoutForm" class="btn btn-checkout w-100">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set tanggal minimum (hari ini)
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_sewa').min = today;

            // Event listener untuk perubahan tanggal
            document.getElementById('tanggal_sewa').addEventListener('change', function() {
                const tanggalKembali = document.getElementById('tanggal_kembali');
                tanggalKembali.min = this.value;

                if (tanggalKembali.value && tanggalKembali.value < this.value) {
                    tanggalKembali.value = this.value;
                }

                hitungDurasiDanHarga();
            });

            document.getElementById('tanggal_kembali').addEventListener('change', hitungDurasiDanHarga);

            function hitungDurasiDanHarga() {
                const tglSewa = document.getElementById('tanggal_sewa').value;
                const tglKembali = document.getElementById('tanggal_kembali').value;

                if (tglSewa && tglKembali) {
                    const diffTime = new Date(tglKembali) - new Date(tglSewa);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                    if (diffDays > 0) {
                        const dailyPrice = 250000;
                        const subtotal = dailyPrice * diffDays;
                        const biayaAsuransi = 50000;
                        const total = subtotal + biayaAsuransi;

                        // Update tampilan
                        document.querySelectorAll('.jumlah-hari').forEach(el => {
                            el.textContent = diffDays;
                        });

                        document.getElementById('total-hari').textContent = diffDays;
                        document.getElementById('subtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                        document.querySelector('.product-item .fw-bold').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
                        document.getElementById('total-pembayaran').textContent = `Rp ${total.toLocaleString('id-ID')}`;
                    }
                }
            }

            // Form submission
            document.getElementById('checkoutForm').addEventListener('submit', function(e) {
                e.preventDefault();

                if (!document.getElementById('setuju-syarat').checked) {
                    alert('Anda harus menyetujui syarat dan ketentuan terlebih dahulu');
                    return;
                }

                // Kirim data ke server
                alert('Pembayaran berhasil diproses!');
                // window.location.href = '/pembayaran-berhasil';
            });
        });
    </script>
</body>
</html>
