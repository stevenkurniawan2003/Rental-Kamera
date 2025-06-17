<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h2 class="mt-3 text-success">Checkout Berhasil!</h2>
                        <p class="lead">Terima kasih atas pemesanan Anda.</p>

                        <div class="alert alert-info">
                            <strong>Kode Transaksi: {{ $transaksi->KODE_TRANSAKSI }}</strong>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Detail Penyewa</h5>
                                <p><strong>Nama:</strong> {{ $transaksi->nama }}</p>
                                <p><strong>Email:</strong> {{ $transaksi->email }}</p>
                                <p><strong>Telepon:</strong> {{ $transaksi->telepon }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Detail Sewa</h5>
                                <p><strong>Tanggal Sewa:</strong> {{ $transaksi->tanggal_sewa->format('d/m/Y') }}</p>
                                <p><strong>Tanggal Kembali:</strong> {{ $transaksi->tanggal_kembali->format('d/m/Y') }}</p>
                                <p><strong>Total:</strong> Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5>Produk yang Disewa</h5>
                            @foreach($transaksi->items as $item)
                                <div class="border p-2 mb-2">
                                    <strong>{{ $item->produk->nama }}</strong> - 
                                    {{ $item->jumlah }} unit × {{ $item->durasi }} hari = 
                                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5">
                            <h5>Lokasi Pengambilan Barang</h5>
                            <p class="text-muted">Silakan ambil barang di lokasi berikut:</p>

                            <!-- Google Map Embed -->
                            <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm mb-4">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.187066309775!2d112.699528!3d-7.558807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb9ed33106c1%3A0x6d7056a72440e1f1!2sToko%20Kamera%20Dummy!5e0!3m2!1sid!2sid!4v1718610043015!5m2!1sid!2sid" 
                                    width="600" 
                                    height="450" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('landingpage') }}" class="btn btn-primary">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@if ($transaksi->metode_pembayaran === 'qris' && isset($snapToken))
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('midtrans.clientKey') }}"></script>

    <div class="mt-4 text-center">
        <h5>Scan untuk Pembayaran:</h5>
        <button id="pay-button" class="btn btn-success">Bayar Sekarang</button>
    </div>

    <script>
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    console.log(result);
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran.");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.log(result);
                },
                onClose: function() {
                    alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                }
            });
        };
    </script>
@endif
