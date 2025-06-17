@extends('layouts.app')

@section('title', 'Checkout Berhasil')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="text-success fw-bold mb-2"><i class="fas fa-check-circle me-2"></i>Checkout Berhasil!</h2>
        <p class="text-muted">Terima kasih telah melakukan pemesanan. Berikut rincian transaksi Anda.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Rincian Transaksi</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Nama:</strong> {{ $transaksi->nama }}
                        </li>
                        <li class="list-group-item">
                            <strong>Kode Transaksi:</strong> 
                            <span class="text-primary">{{ $kodeTransaksi }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Metode Pembayaran:</strong> <span class="text-danger">Bayar di Tempat (COD)</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Total yang Harus Dibayarkan:</strong>
                            <span class="fw-bold text-success">Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Tanggal Sewa:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_sewa)->format('d M Y') }}<br>
                            <strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d M Y') }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Lokasi Pengambilan Barang</h5>
                    <p class="text-muted mb-3">Silakan ambil barang sewaan Anda di lokasi berikut:</p>

                    <!-- Google Maps Embed -->
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.298236707231!2d112.68803237407589!3d-7.53489789245927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd803205baab9b7%3A0xf8264a1c36aa3c5d!2sKamera%20Rental%20Center!5e0!3m2!1sid!2sid!4v1718582760411!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="mt-3 text-muted small">Alamat: Jl. Kalimantan No. 333, Jember, Jawa Timur</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
