@extends('layouts.app')

@section('title', 'Detail Produk - Rental Camera')

@section('styles')
<style>
    .product-hero {
        background-color: #ffffff;
        padding: 30px 0;
    }

    .back-button {
        margin-bottom: 20px;
    }

    .product-container {
        display: flex;
        gap: 30px;
    }

    .product-image {
        flex: 1;
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-image img {
        max-width: 100%;
        max-height: 400px;
        object-fit: contain;
    }

    .product-info {
        flex: 1;
    }

    .product-header {
        margin-bottom: 20px;
    }

    .product-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #333;
    }

    .product-subtitle {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 15px;
    }

    .stock-status {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .in-stock {
        background-color: #e8f5e9;
        color: #2e7d32;
    }

    .price-container {
        margin-bottom: 25px;
    }

    .product-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0d6efd;
    }

    .price-period {
        font-size: 1rem;
        color: #6c757d;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .btn-rent {
        flex: 1;
        padding: 12px;
        font-weight: 600;
    }

    .specification-section {
        margin-top: 30px;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 8px;
    }

    .spec-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .spec-item {
        margin-bottom: 12px;
    }

    .spec-label {
        font-weight: 600;
        color: #555;
        font-size: 0.95rem;
    }

    .spec-value {
        color: #333;
    }

    .accessories-list {
        list-style-type: none;
        padding-left: 0;
    }

    .accessories-list li {
        padding: 5px 0;
        display: flex;
        align-items: center;
    }

    .accessories-list li:before {
        content: "•";
        color: #0d6efd;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
    }

    @media (max-width: 768px) {
        .product-container {
            flex-direction: column;
        }

        .action-buttons {
            flex-direction: column;
        }

        .spec-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<section class="product-hero">
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary back-button">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>

        <div class="product-container">
            <div class="product-image">
                <img src="{{ asset('storage/produk/' . $produk->gambar) }}" alt="{{ $produk->nama }}">
            </div>

            <div class="product-info">
                <div class="product-header">
                    <h1 class="product-title">{{ $produk->nama }}</h1>
                    <p class="product-subtitle">{{ $produk->merek }} - {{ $produk->kategori }}</p>

                    <span class="stock-status in-stock">
                        Tersedia • Stok {{ $produk->stok }} unit
                    </span>
                </div>

                <div class="price-container">
                    <span class="product-price">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                    <span class="price-period">/hari</span>
                </div>

                @auth
                    @if($produk->stok > 0)
                    <div class="action-buttons">
                        <button class="btn btn-primary btn-rent" data-bs-toggle="modal" data-bs-target="#addToCartModal">
                            <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                        </button>
                        <button class="btn btn-outline-primary btn-rent" data-bs-toggle="modal" data-bs-target="#rentNowModal">
                            <i class="fas fa-calendar-alt me-2"></i>Sewa Sekarang
                        </button>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Produk ini sedang tidak tersedia
                    </div>
                    @endif
                @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Silahkan <a href="{{ route('login') }}" class="alert-link">login</a> terlebih dahulu untuk menyewa produk ini.
                    </div>
                @endauth

                <div class="specification-section">
                    <h3 class="section-title">Spesifikasi</h3>
                    <div class="spec-grid">
                        <div class="spec-item">
                            <div class="spec-label">Merek</div>
                            <div class="spec-value">{{ $produk->merek }}</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Model</div>
                            <div class="spec-value">{{ $produk->nama }}</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Tipe</div>
                            <div class="spec-value">{{ $produk->kategori }}</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Kondisi</div>
                            <div class="spec-value">{{ $produk->kondisi }}</div>
                        </div>
                        <div class="spec-item">
                            <div class="spec-label">Deskripsi</div>
                            <div class="spec-value">{{ $produk->deskripsi }}</div>
                        </div>
                    </div>
                </div>

                <div class="specification-section mt-4">
                    <h3 class="section-title">Aksesoris Termasuk</h3>
                    <ul class="accessories-list">
                        @if(strtolower($produk->kategori) === 'aksesoris')
                            <li>-</li>
                        @else
                            <li>Battery</li>
                            <li>Charger</li>
                            <li>Memory Card 64GB</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah ke Keranjang -->
@auth
<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addToCartModalLabel">Tambah ke Keranjang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <p class="text-muted mb-4">Atur detail penyewaan untuk <strong>{{ $produk->nama }}</strong></p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('keranjang.tambah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $produk->id }}">
                    <input type="hidden" name="action_type" value="add_to_cart">
                    <input type="hidden" name="duration" id="addToCartDurationInput">

                    <!-- Jumlah -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Jumlah</label>
                        <div class="d-flex align-items-center">
                            <input type="number" class="form-control w-25" name="quantity"
                                min="1" max="{{ $produk->stok }}" value="1" required id="addToCartQuantity">
                            <span class="ms-2 text-muted">(Stok {{ $produk->stok }} unit)</span>
                        </div>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start_date" required id="addToCartStartDate">
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="end_date" required id="addToCartEndDate">
                    </div>

                    <!-- Rincian Harga -->
                    <div class="price-summary bg-light p-3 rounded mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Harga per hari:</span>
                            <span class="fw-bold">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Durasi:</span>
                            <span class="fw-bold" id="addToCartDurationText">1 hari</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Jumlah:</span>
                            <span class="fw-bold" id="addToCartQuantityText">1 unit</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total Biaya:</span>
                            <span class="fw-bold text-primary" id="addToCartTotalPriceText">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-shopping-cart me-2"></i>Tambah ke Keranjang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sewa Sekarang -->
<div class="modal fade" id="rentNowModal" tabindex="-1" aria-labelledby="rentNowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="rentNowModalLabel">Sewa Sekarang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <p class="text-muted mb-4">Atur detail penyewaan untuk <strong>{{ $produk->nama }}</strong></p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('keranjang.tambah') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $produk->id }}">
                    <input type="hidden" name="action_type" value="rent_now">
                    <input type="hidden" name="duration" id="rentNowDurationInput">

                    <!-- Jumlah -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Jumlah</label>
                        <div class="d-flex align-items-center">
                            <input type="number" class="form-control w-25" name="quantity"
                                min="1" max="{{ $produk->stok }}" value="1" required id="rentNowQuantity">
                            <span class="ms-2 text-muted">(Stok {{ $produk->stok }} unit)</span>
                        </div>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start_date" required id="rentNowStartDate">
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="end_date" required id="rentNowEndDate">
                    </div>

                    <!-- Rincian Harga -->
                    <div class="price-summary bg-light p-3 rounded mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Harga per hari:</span>
                            <span class="fw-bold">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Durasi:</span>
                            <span class="fw-bold" id="rentNowDurationText">1 hari</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Jumlah:</span>
                            <span class="fw-bold" id="rentNowQuantityText">1 unit</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total Biaya:</span>
                            <span class="fw-bold text-primary" id="rentNowTotalPriceText">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calendar-alt me-2"></i>Sewa Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing modals...');
    
    // Initialize both modals
    initModal('addToCart');
    initModal('rentNow');

    function initModal(modalType) {
        console.log('Initializing modal:', modalType);
        
        const today = new Date().toISOString().split('T')[0];
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowStr = tomorrow.toISOString().split('T')[0];

        // Get elements
        const startDateInput = document.getElementById(`${modalType}StartDate`);
        const endDateInput = document.getElementById(`${modalType}EndDate`);
        const quantityInput = document.getElementById(`${modalType}Quantity`);
        const durationText = document.getElementById(`${modalType}DurationText`);
        const quantityText = document.getElementById(`${modalType}QuantityText`);
        const totalPriceText = document.getElementById(`${modalType}TotalPriceText`);
        const durationInput = document.getElementById(`${modalType}DurationInput`);

        // Check if all elements exist
        if (!startDateInput || !endDateInput || !quantityInput || !durationText || !quantityText || !totalPriceText || !durationInput) {
            console.error('Missing elements for modal:', modalType);
            return;
        }

        // Set initial dates
        startDateInput.min = today;
        startDateInput.value = today;
        endDateInput.min = tomorrowStr;
        endDateInput.value = tomorrowStr;

        // Initial calculation
        calculatePrice();

        function calculatePrice() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);
            const quantity = parseInt(quantityInput.value) || 1;
            const pricePerDay = {{ $produk->harga }};

            // Calculate duration (minimum 1 day)
            const diffTime = endDate - startDate;
            const diffDays = Math.max(1, Math.ceil(diffTime / (1000 * 60 * 60 * 24)));

            console.log(`${modalType} - Start:`, startDate, 'End:', endDate, 'Days:', diffDays, 'Quantity:', quantity);

            // Update hidden input
            durationInput.value = diffDays;

            // Update display
            durationText.textContent = diffDays + ' hari';
            quantityText.textContent = quantity + ' unit';

            // Calculate and format total price
            const totalPrice = diffDays * pricePerDay * quantity;
            totalPriceText.textContent = 'Rp' + totalPrice.toLocaleString('id-ID');

            console.log(`${modalType} - Total price:`, totalPrice);
        }

        // Event listeners
        startDateInput.addEventListener('change', function() {
            const startDate = new Date(this.value);
            const minEndDate = new Date(startDate);
            minEndDate.setDate(startDate.getDate() + 1);

            endDateInput.min = minEndDate.toISOString().split('T')[0];

            if (new Date(endDateInput.value) < minEndDate) {
                endDateInput.value = minEndDate.toISOString().split('T')[0];
            }

            calculatePrice();
        });

        endDateInput.addEventListener('change', calculatePrice);
        quantityInput.addEventListener('input', calculatePrice);
        quantityInput.addEventListener('change', calculatePrice);

        console.log('Modal initialized successfully:', modalType);
    }
});
</script>
@endpush
@endsection