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

<div class="modal fade" id="editProdukModal" tabindex="-1" aria-labelledby="editProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProdukModalLabel">Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProdukForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Informasi Dasar -->
                            <div class="form-section">
                                <h6 class="form-section-title">Informasi Dasar</h6>

                                <div class="mb-3">
                                    <label for="edit_nama" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="edit_nama" name="nama" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="edit_kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Kamera DSLR">Kamera DSLR</option>
                                        <option value="Kamera Mirrorless">Kamera Mirrorless</option>
                                        <option value="Lensa">Lensa</option>
                                        <option value="Aksesoris">Aksesoris</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="merek" class="form-label">Merek</label>
                                    <input list="daftar-merek" class="form-control" id="merek" name="merek" required placeholder="Pilih atau ketik merek">
                                    <datalist id="daftar-merek">
                                        <option value="Canon">
                                        <option value="Nikon">
                                        <option value="Sony">
                                        <option value="Fujifilm">
                                        <option value="Panasonic">
                                        <option value="Olympus">
                                    </datalist>
                                </div>
                            </div>

                            </div>

                            <!-- Harga & Stok -->
                            <div class="form-section">
                                <h6 class="form-section-title">Harga & Stok</h6>

                                <div class="mb-3">
                                    <label for="edit_harga" class="form-label">Harga Sewa per Hari</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="edit_harga" name="harga" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_stok" class="form-label">Stok Tersedia</label>
                                    <input type="number" class="form-control" id="edit_stok" name="stok" min="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Spesifikasi Teknis -->
                            <div class="form-section">
                                <h6 class="form-section-title">Spesifikasi Teknis</h6>

                                <div class="mb-3">
                                    <label for="kondisi" class="form-label">Kondisi</label>
                                    <select class="form-select" id="kondisi" name="kondisi" required>
                                        <option value="">Pilih Kondisi</option>
                                        <option value="Baru">Baru</option>
                                        <option value="Sangat Baik">Sangat Baik</option>
                                        <option value="Baik">Baik</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Gambar Produk -->
                            <div class="form-section">
                                <h6 class="form-section-title">Gambar Produk</h6>

                                <div class="mb-3">
                                    <label for="edit_gambar" class="form-label">Upload Gambar Baru</label>
                                    <input type="file" class="form-control" id="edit_gambar" name="gambar">
                                    <div class="preview-image mt-2">
                                        <img id="edit_preview" src="#" alt="Preview Gambar" class="img-thumbnail" style="max-height: 200px; display: none;">
                                    </div>
                                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-section">
                        <h6 class="form-section-title">Deskripsi Produk</h6>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
