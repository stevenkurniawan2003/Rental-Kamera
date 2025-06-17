@extends('layouts.app')

@section('title', 'Riwayat Sewa')

@section('content')
<div class="container py-4">
    <h2 class="text-2xl font-bold mb-4">Riwayat Sewa</h2>

    @forelse ($transaksis as $trx)
        <div class="bg-white shadow rounded p-4 mb-4">
            <p><strong>Kode Transaksi:</strong> {{ $trx->KODE_TRANSAKSI }}</p>
            <p><strong>Tanggal Sewa:</strong> {{ $trx->tanggal_sewa }}</p>
            <p><strong>Tanggal Kembali:</strong> {{ $trx->tanggal_kembali }}</p>
            <p><strong>Total:</strong> Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</p>

            <ul class="mt-2 list-disc pl-5">
                @foreach ($trx->items as $item)
                    <li>{{ $item->produk->nama }} - {{ $item->jumlah }} unit × {{ $item->durasi }} hari = Rp{{ number_format($item->subtotal, 0, ',', '.') }}</li>
                @endforeach
            </ul>
        </div>
    @empty
        <p>Belum ada riwayat sewa.</p>
    @endforelse
</div>
@endsection
