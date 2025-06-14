<style>
    .modal-lg {
        max-width: 800px;
    }

    .preview-image img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .form-section {
        margin-bottom: 1.5rem;
    }

    .form-section-title {
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #eee;
    }
</style>

<div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahProdukModalLabel">Tambah Produk Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('produk.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Informasi Dasar -->
                            <div class="form-section">
                                <h6 class="form-section-title">Informasi Dasar</h6>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Kamera DSLR">Kamera DSLR</option>
                                        <option value="Kamera Mirrorless">Kamera Mirrorless</option>
                                        <option value="Lensa">Lensa</option>
                                        <option value="Aksesoris">Aksesoris</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="merek" class="form-label">Merek</label>
                                    <select class="form-select" id="merek" name="merek" required>
                                        <option value="">Pilih Merek</option>
                                        <option value="Canon">Canon</option>
                                        <option value="Nikon">Nikon</option>
                                        <option value="Sony">Sony</option>
                                        <option value="Fujifilm">Fujifilm</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Harga & Stok -->
                            <div class="form-section">
                                <h6 class="form-section-title">Harga & Stok</h6>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Sewa per Hari</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="harga" name="harga" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="stok" class="form-label">Stok Tersedia</label>
                                    <input type="number" class="form-control" id="stok" name="stok" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Spesifikasi Teknis -->
                            <div class="form-section">
                                <h6 class="form-section-title">Spesifikasi Teknis</h6>

                                <div class="mb-3">
                                    <label for="kondisi" class="form-label">Kondisi</label>
                                    <input type="text" class="form-control" id="kondisi" name="kondisi" required>
                                </div>

                                <div class="mb-3">
                                    <label for="sensor" class="form-label">Sensor</label>
                                    <input type="text" class="form-control" id="sensor" name="sensor" required>
                                </div>

                                <div class="mb-3">
                                    <label for="iso" class="form-label">Iso Range</label>
                                    <input type="text" class="form-control" id="iso" name="iso" required>
                                </div>
                            </div>

                            <!-- Gambar Produk -->
                            <div class="form-section">
                                <h6 class="form-section-title">Gambar Produk</h6>

                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Upload Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" required>
                                    <div class="preview-image mt-2" style="display: none;">
                                        <img id="preview" src="#" alt="Preview Gambar" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                    <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-section">
                        <h6 class="form-section-title">Deskripsi Produk</h6>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi lengkap produk..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview gambar sebelum upload
    document.getElementById('gambar').addEventListener('change', function(e) {
        const previewContainer = document.querySelector('.preview-image');
        const preview = document.getElementById('preview');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }

            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            previewContainer.style.display = 'none';
        }
    });
</script>
