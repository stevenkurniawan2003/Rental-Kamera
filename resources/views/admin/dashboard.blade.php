@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('styles')

@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">Manajemen Produk</h2>
    </div>
    <div class="col-md-6 text-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
            <i class="fas fa-plus me-2"></i>Tambah Produk
        </button>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <select class="form-select">
                    <option selected>Semua Kategori</option>
                    <option>Kamera DSLR</option>
                    <option>Kamera Mirrorless</option>
                    <option>Lensa</option>
                    <option>Aksesoris</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-select">
                    <option selected>Semua Merek</option>
                    <option>Canon</option>
                    <option>Nikon</option>
                    <option>Sony</option>
                    <option>Fujifilm</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-select">
                    <option selected>Status Stok</option>
                    <option>Tersedia</option>
                    <option>Habis</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse ($produks as $produk)
    <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
        <div class="product-card">
            <div class="product-img-container">
                <img src="{{ asset('storage/produk/' . $produk->gambar) }}" class="product-img" alt="{{ $produk->nama }}">
            </div>
            <div class="product-body">
                <h5 class="product-title">{{ $produk->nama }}</h5>
                <p class="product-category">{{ $produk->kategori }}</p>
                <div class="product-price">Rp{{ number_format($produk->harga, 0, ',', '.') }}/hari</div>
                <span class="stock-badge {{ $produk->stok > 0 ? 'in-stock' : 'out-stock' }}">
                    {{ $produk->stok > 0 ? 'Tersedia (' . $produk->stok . ')' : 'Habis' }}
                </span>
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-sm btn-outline-primary action-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#editProdukModal"
                            data-id="{{ $produk->id }}"
                            data-nama="{{ $produk->nama }}"
                            data-harga="{{ $produk->harga }}"
                            data-stok="{{ $produk->stok }}"
                            data-kategori="{{ $produk->kategori }}"
                            data-merek="{{ $produk->merek }}"
                            data-deskripsi="{{ $produk->deskripsi }}"
                            data-gambar="{{ $produk->gambar ? asset('storage/produk/' . $produk->gambar) : '' }}">
                        <i class="fas fa-edit me-1"></i> Edit
                    </button>
                    <form action="{{ route('produk.delete', $produk->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger action-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </button>
                    </form>
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
</div>
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

@include('components.modal.tambah-produk')
@include('components.modal.edit-produk', ['produk' => $produk])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tangkap event saat modal edit akan ditampilkan
        $('#editProdukModal').on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget); // Tombol yang memicu modal
            const produk = {
                id: button.data('id'),
                nama: button.data('nama'),
                harga: button.data('harga'),
                stok: button.data('stok'),
                kategori: button.data('kategori'),
                merek: button.data('merek'),
                deskripsi: button.data('deskripsi'),
                gambar: button.data('gambar')
            };

            // Update form action dengan ID produk
            $('#editProdukForm').attr('action', '/produk/' + produk.id);

            // Isi form dengan data produk
            $('#edit_nama').val(produk.nama);
            $('#edit_harga').val(produk.harga);
            $('#edit_stok').val(produk.stok);
            $('#edit_kategori').val(produk.kategori);
            $('#edit_merek').val(produk.merek);
            $('#edit_deskripsi').val(produk.deskripsi);

            // Set preview gambar
            if (produk.gambar) {
                $('#edit_preview').attr('src', produk.gambar).show();
            } else {
                $('#edit_preview').hide();
            }
        });

        // Preview gambar saat file dipilih
        $('#edit_gambar').change(function(e) {
            const input = e.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#edit_preview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
    </script>
@endsection
