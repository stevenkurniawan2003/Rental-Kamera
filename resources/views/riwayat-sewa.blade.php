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

            <!-- Countdown Timer -->
            <p>
                <strong>Status Waktu:</strong>
                <span class="countdown text-sm font-semibold" data-deadline="{{ $trx->tanggal_kembali }} 23:59:00" id="countdown-{{ $trx->id }}"></span>
            </p>

            <!-- Item List -->
            <ul class="mt-2 list-disc pl-5">
                @foreach ($trx->items as $item)
                    <li>
                        {{ $item->produk->nama }} - 
                        {{ $item->jumlah }} unit × 
                        {{ $item->durasi }} hari = 
                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <p>Belum ada riwayat sewa.</p>
    @endforelse
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const countdowns = document.querySelectorAll('.countdown');

    countdowns.forEach(function (el) {
        const deadline = new Date(el.dataset.deadline).getTime();

        const interval = setInterval(function () {
            const now = new Date().getTime();
            let distance = deadline - now;

            const late = distance < 0;
            distance = Math.abs(distance);

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            el.innerHTML =
                (late ? "<span class='text-red-600'>Lewat</span> - " : "") +
                days + "h " + hours + "j " + minutes + "m " + seconds + "d";

        }, 1000);
    });
});
</script>
@endpush
