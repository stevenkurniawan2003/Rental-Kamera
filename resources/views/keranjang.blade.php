@extends('layouts.app')

@section('title', 'Keranjang - Rental Camera')

@section('styles')
<style>
    .cart-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .cart-item {
        display: flex;
        gap: 20px;
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }

    .cart-item-image {
        width: 120px;
        height: 120px;
        object-fit: contain;
        border-radius: 8px;
        background-color: #f8f9fa;
        padding: 10px;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .cart-item-price {
        color: #0d6efd;
        font-weight: 600;
    }

    .cart-item-duration {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .cart-summary {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .summary-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .summary-total {
        font-weight: 600;
        font-size: 1.1rem;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #ddd;
    }

    .btn-checkout {
        width: 100%;
        padding: 12px;
        font-weight: 600;
        margin-top: 20px;
    }

    .empty-cart {
        text-align: center;
        padding: 50px 0;
        margin-left: 60vh;
    }

    .empty-cart-icon {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 20px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        text-align: center;
        height: 38px;
        -moz-appearance: textfield;
    }

    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .quantity-control button {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .quantity-control button i {
        font-size: 12px;
    }
</style>
@endsection
@section('content')
<section class="py-5">
    <div class="container">
        <a href="{{ route('landingpage')}}" class="btn btn-outline-secondary back-button mb-2">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
        <h2 class="mb-4">Keranjang Penyewaan</h2>

        <div class="row">
            <div class="col-lg-8">
                <div class="cart-container">
                    @if(count($cartItems) > 0)
                        @foreach($cartItems as $item)
                            <div class="cart-item">
                                <img src="{{ asset('storage/produk/' . $item->produk->gambar) }}" alt="{{ $item->produk->nama }}" class="cart-item-image">
                                <div class="cart-item-details">
                                    <h5 class="cart-item-title">{{ $item->produk->nama }}</h5>
                                    <p class="cart-item-price">Rp{{ number_format($item->produk->harga, 0, ',', '.') }} /hari</p>
                                    <p class="cart-item-duration">
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }} •
                                        {{ $item->duration }} hari
                                    </p>
                                    <div class="d-flex align-items-center mt-2">
                                        <span class="fw-bold me-3">Jumlah:</span>
                                        <div class="quantity-control d-flex align-items-center">
                                            <button class="btn btn-sm btn-outline-secondary decrement"
                                                    type="button"
                                                    data-id="{{ $item->id }}"
                                                    data-stok="{{ $item->produk->stok }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number"
                                                class="form-control quantity-input mx-2 text-center"
                                                value="{{ $item->jumlah }}"
                                                min="1"
                                                max="{{ $item->produk->stok }}"
                                                data-id="{{ $item->id }}"
                                                data-stok="{{ $item->produk->stok }}"
                                                style="width: 60px;">
                                            <button class="btn btn-sm btn-outline-secondary increment"
                                                    type="button"
                                                    data-id="{{ $item->id }}"
                                                    data-stok="{{ $item->produk->stok }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="fw-bold">Subtotal: <span class="subtotal" data-id="{{ $item->id }}">
                                            Rp{{ number_format($item->total_price, 0, ',', '.') }}
                                        </span></span>
                                        <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-cart">
                            <div class="empty-cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h4>Keranjang Anda Kosong</h4>
                            <p class="text-muted">Silahkan tambahkan produk terlebih dahulu</p>
                            <a href="{{ route('kataloguser') }}" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-camera me-2"></i>Lihat Katalog
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            @if(count($cartItems) > 0)
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="cart-summary">
                    <h5 class="summary-title">Ringkasan Pesanan</h5>

                    @foreach($cartItems as $item)
                    <div class="summary-item">
                        <span>{{ $item->produk->nama }} ({{ $item->jumlah }}x)</span>
                        <span>Rp{{ number_format($item->total_price, 0, ',', '.') }}</span>
                    </div>
                    @endforeach

                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span>Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="btn btn-primary btn-checkout">
                        <i class="fas fa-credit-card me-2"></i>Lanjut ke Pembayaran
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@push('scripts')
<script>
$(document).ready(function() {
    // Fungsi update quantity (sama seperti sebelumnya)
    function updateQuantity(id, quantity) {
        $.ajax({
            url: '/keranjang/update/' + id,
            method: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    $('.subtotal[data-id="' + id + '"]').text(response.subtotal);
                    // Update total jika diperlukan
                }
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                Swal.fire('Error', response.message, 'error');
                location.reload();
            }
        });
    }

    // Tombol tambah
    $(document).on('click', '.increment', function() {
        const id = $(this).data('id');
        const stok = $(this).data('stok');
        const input = $(this).siblings('.quantity-input');
        let value = parseInt(input.val());

        if (value < stok) {
            input.val(value + 1).trigger('change');
        } else {
            Swal.fire('Peringatan', 'Jumlah tidak boleh melebihi stok: ' + stok, 'warning');
        }
    });

    // Tombol kurang
    $(document).on('click', '.decrement', function() {
        const input = $(this).siblings('.quantity-input');
        let value = parseInt(input.val());

        if (value > 1) {
            input.val(value - 1).trigger('change');
        }
    });

    // Input manual
    $(document).on('change', '.quantity-input', function() {
        const id = $(this).data('id');
        const stok = $(this).data('stok');
        let value = parseInt($(this).val());

        if (isNaN(value) || value < 1) {
            value = 1;
            $(this).val(1);
        } else if (value > stok) {
            value = stok;
            $(this).val(stok);
            Swal.fire('Peringatan', 'Jumlah tidak boleh melebihi stok: ' + stok, 'warning');
        }

        updateQuantity(id, value);
    });
});
</script>
@endpush

@endsection
