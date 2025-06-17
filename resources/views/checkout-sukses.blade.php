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