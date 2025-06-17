@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h2>Pembayaran QRIS</h2>
    <p>Silakan lanjutkan pembayaran melalui Midtrans Snap.</p>
    <button id="pay-button" class="btn btn-success">Bayar Sekarang</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran sukses!");
                window.location.href = "/checkout/sukses/{{ session('kode_transaksi') }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran.");
            },
            onError: function(result){
                alert("Pembayaran gagal.");
            }
        });
    };
</script>
@endsection
