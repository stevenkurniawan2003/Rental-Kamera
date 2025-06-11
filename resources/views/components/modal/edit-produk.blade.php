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
                            <!-- Upload Gambar -->
                            <div class="mb-3">
                                <label for="edit_gambar" class="form-label">Gambar Produk</label>
                                <input type="file" class="form-control" id="edit_gambar" name="gambar">
                                <div class="preview-image mt-2">
                                    <img id="edit_preview" src="#" alt="Preview Gambar" class="img-thumbnail" style="max-height: 200px; display: none;">
                                </div>
                            </div>

                            <!-- Nama Produk -->
                            <div class="mb-3">
                                <label for="edit_nama" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="edit_nama" name="nama" required>
                            </div>

                            <!-- Harga -->
                            <div class="mb-3">
                                <label for="edit_harga" class="form-label">Harga Sewa per Hari</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="edit_harga" name="harga" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Stok -->
                            <div class="mb-3">
                                <label for="edit_stok" class="form-label">Stok Tersedia</label>
                                <input type="number" class="form-control" id="edit_stok" name="stok" min="0" required>
                            </div>

                            <!-- Kategori -->
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

                            <!-- Merek -->
                            <div class="mb-3">
                                <label for="edit_merek" class="form-label">Merek</label>
                                <select class="form-select" id="edit_merek" name="merek" required>
                                    <option value="">Pilih Merek</option>
                                    <option value="Canon">Canon</option>
                                    <option value="Nikon">Nikon</option>
                                    <option value="Sony">Sony</option>
                                    <option value="Fujifilm">Fujifilm</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
