<div id="modal_edit" class="modal right fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable w-100">
        <form class="modal-content" id="form-edit" method="POST" action="<?php echo base_url() . 'user/edit' ?>" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title">Ubah Data <br>
                    <span class="font-weight-normal small text-capitalize" id="modal-title-edit"></span>
                </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_edit" name="id_edit" readonly>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Kode Pengguna</label>
                            <input type="text" class="form-control" id="kode_edit" placeholder="Kode Pengguna" name="kode_edit" value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control text-only" id="first_name_edit" placeholder="Nama Pengguna" name="first_name_edit" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control number-nospace" id="nik_edit" placeholder="NIK" name="nik_edit" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_edit" placeholder="Email" name="email_edit" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control number-nospace" id="phone_edit" placeholder="Nomor Telepon" name="phone_edit" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="hidden" id="photo_old_edit" name="photo_old_edit">
                            <input type="file" class="form-control" id="photo_edit" placeholder="Foto Pengguna" name="photo_edit" accept="image/*">
                            <br>
                            <div id="imagePreview">
                                <img src="" id="img_preview_edit" class="bg-light border rounded-1">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Hak Akses</label>
                            <select class="form-control" id="role_id_edit" name="role_id_edit" placeholder="Hak Akses" data-selectjs="true">
                                <option value="">Pilih Hak Akses</option>
                                <?php if (!empty($roles)) {
	foreach ($roles as $key => $value) {
		?>
                                <option value="<?php echo $value->id ?>">
                                    <?php echo ucfirst($value->name); ?>
                                </option>
                                <?php }}?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <select class="form-control provinsi-id" id="provinsi_id_edit" name="provinsi_id_edit" placeholder="Provinsi" data-selectjs="true">
                                <?php if (!empty($provinsi)) {
	foreach ($provinsi as $key => $value) {
		?>
                                <option selected value="<?php echo $value->id ?>">
                                    <?php echo $value->name; ?>
                                </option>
                                <?php }}?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kota / Kabupaten</label>
                            <select class="form-control kabupaten-id" id="kabupaten_id_edit" name="kabupaten_id_edit" placeholder="Kota / Kabupaten" data-selectjs="true">
                                <option value="">Pilih Kota / Kabupaten</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <select class="form-control kecamatan-id" id="kecamatan_id_edit" name="kecamatan_id_edit" placeholder="Kecamatan" data-selectjs="true">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelurahan</label>
                            <select class="form-control kelurahan-id" id="kelurahan_id_edit" name="kelurahan_id_edit" placeholder="Kelurahan" data-selectjs="true">
                                <option value="">Pilih Kelurahan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control text-only" id="address_edit" placeholder="Alamat" name="address_edit" rows="9"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control number-nospace" id="nip_edit" placeholder="NIP" name="nip_edit" value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Jabatan</label>
                            <input type="text" class="form-control text-only" name="jabatan_edit" id="jabatan_edit" autocomplete="off" placeholder="Jabatan">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Golongan</label>
                            <select class="form-control" id="golongan_id_edit" name="golongan_id_edit" placeholder="Golongan" data-selectjs="true">
                                <option value="">Pilih Golongan</option>
                                <?php if (!empty($jabatan)) {
	foreach ($jabatan as $key => $value) {
		?>
                                <option value="<?php echo $value->id ?>">
                                    <?php echo $value->nama_golongan . " - " . $value->nama_jabatan; ?>
                                </option>
                                <?php }}?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost-primary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" name="simpan" class="btn btn-yellow ms-auto">Simpan</button>
            </div>
        </form>
    </div>
</div>