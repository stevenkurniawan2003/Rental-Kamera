@extends('layouts.app')

@section('title', 'Katalog Produk - Rental Camera')

@section('styles')
<style>
    .catalog-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                    url('https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 120px 0;
        text-align: center;
        margin-bottom: 50px;
    }

    .search-section {
        background-color: #f8f9fa;
        padding: 20px 0;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .filter-dropdown {
        margin-right: 15px;
        margin-bottom: 15px;
    }

    .filter-dropdown .btn {
        background-color: white;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 8px 15px;
    }

    .filter-dropdown .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        padding: 10px;
    }

    .filter-dropdown .form-check {
        padding: 5px 20px;
    }

    .product-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .product-img-container {
        height: 200px;
        overflow: hidden;
        position: relative;
        background-color: #f8f9fa;
    }

    .product-img {
        height: 100%;
        width: 100%;
        object-fit: contain;
        padding: 15px;
    }

    .badge-availability {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 20px;
    }

    .product-info {
        padding: 15px;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-category {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .product-price {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0d6efd;
        margin-bottom: 10px;
    }

    .product-stock {
        font-size: 0.85rem;
        color: #000000;
        margin-bottom: 15px;
    }

    .product-actions {
        display: flex;
        gap: 10px;
    }

    .product-actions .btn {
        flex: 1;
        border-radius: 8px;
        font-size: 0.85rem;
        padding: 8px;
    }

    .sort-dropdown .btn {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 8px 15px;
    }

    .pagination {
        justify-content: center;
        margin-top: 30px;
    }

    .pagination .page-item .page-link {
        border-radius: 8px;
        margin: 0 5px;
        border: 1px solid #ddd;
        color: #333;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="catalog-hero">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Katalog Peralatan Kamera</h1>
        <p class="lead">Temukan peralatan fotografi terbaik untuk kebutuhan profesional Anda</p>
    </div>
</section>

<div class="container">
    <!-- Search and Filter Section -->
    <section class="search-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Cari kamera, lensa, atau aksesoris...">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 d-flex flex-wrap">
                    <!-- Category Dropdown -->
                    <div class="filter-dropdown">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-list me-2"></i>Kategori
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="category1" checked>
                                        <label class="form-check-label" for="category1">
                                            Kamera DSLR
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="category2">
                                        <label class="form-check-label" for="category2">
                                            Kamera Mirrorless
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="category3">
                                        <label class="form-check-label" for="category3">
                                            Lensa
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="category4">
                                        <label class="form-check-label" for="category4">
                                            Aksesoris
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Brand Dropdown -->
                    <div class="filter-dropdown">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="brandDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-tag me-2"></i>Merek
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="brandDropdown">
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand1" checked>
                                        <label class="form-check-label" for="brand1">
                                            Canon
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand2">
                                        <label class="form-check-label" for="brand2">
                                            Nikon
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand3">
                                        <label class="form-check-label" for="brand3">
                                            Sony
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="brand4">
                                        <label class="form-check-label" for="brand4">
                                            Fujifilm
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Availability Dropdown -->
                    <div class="filter-dropdown">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="availabilityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-check-circle me-2"></i>Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="availabilityDropdown">
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="availability" id="available" checked>
                                        <label class="form-check-label" for="available">
                                            Tersedia
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="availability" id="all">
                                        <label class="form-check-label" for="all">
                                            Tampilkan Semua
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Reset Button -->
                    <div class="filter-dropdown">
                        <button class="btn btn-outline-secondary">
                            <i class="fas fa-sync-alt me-2"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products-section">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Menampilkan 8 Produk</h4>
            <div class="dropdown sort-dropdown">
                <button class="btn dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sort me-2"></i>Urutkan: Paling Sesuai
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-check me-2"></i>Paling Sesuai</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sort-amount-down me-2"></i>Harga Terendah</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sort-amount-up me-2"></i>Harga Tertinggi</a></li>
                </ul>
            </div>
        </div>

        <div class="row">
           @forelse ($produks as $produk)
           <div class="col-md-4 col-lg-3 mb-4">
               <div class="product-card">
                   <div class="product-img-container">
                       <img src="{{ asset('storage/produk/' . $produk->gambar) }}" class="product-img" alt="{{ $produk->nama }}">
                    </div>
                    <div class="product-info">
                        <h5 class="product-title">{{ $produk->nama }}</h5>
                        <p class="product-category">{{ $produk->kategori }}</p>
                        <div class="product-price">Rp{{ number_format($produk->harga, 0, ',', '.') }}/hari</div>
                        <div class="product-stock">
                            <span class="stock-badge {{ $produk->stok > 0 ? 'in-stock' : 'out-stock' }}">
                                {{ $produk->stok > 0 ? 'Tersedia (' . $produk->stok . ')' : 'Habis' }}
                            </span>
                        </div>
                        <div class="product-actions">
                            @if($produk->stok > 0)
                                <button class="btn btn-primary"><i class="fas fa-shopping-cart me-2"></i>Sewa</button>
                            @else
                                <button class="btn btn-secondary" disabled><i class="fas fa-shopping-cart me-2"></i>Habis</button>
                            @endif
                            <button class="btn btn-outline-secondary">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 py-12 text-center">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-camera"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-500 mb-2">Belum Ada Data Produk</h3>
            </div>
            @endforelse

        <!-- Pagination -->
        @if($produks->hasPages())
            <div class="mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if($produks->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-left me-1"></i> Previous
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $produks->previousPageUrl() }}">
                                    <i class="fas fa-chevron-left me-1"></i> Previous
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($produks->links()->elements[0] as $page => $url)
                            @if($page == $produks->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($produks->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $produks->nextPageUrl() }}">
                                    Next <i class="fas fa-chevron-right ms-1"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">
                                    Next <i class="fas fa-chevron-right ms-1"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </section>
</div>
@endsection
