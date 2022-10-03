<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah <?php echo $page_description; ?></h1>
</div>

<div class="card shadow mb-4">
    <form class="modal-content" id="form" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pengguna</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control number-nospace" id="nip" placeholder="NIP" name="nip" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control text-only" id="first_name" placeholder="Nama Pengguna" name="first_name" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NIK</label>
                        <input type="text" class="form-control number-nospace" id="nik" placeholder="NIK" name="nik" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control number-nospace" id="phone" placeholder="Nomor Telepon" name="phone" value="">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" id="photo" placeholder="Foto Pengguna" name="photo" accept="image/*">
                        <br>
                        <div id="imagePreview">
                            <img src="" id="img_preview" class="img-responsive" width="100px">
                        </div>
                    </div>
                </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Provinsi</label>
                            <select class="form-control provinsi-id" id="provinsi_id" name="provinsi_id" placeholder="Provinsi" data-selectjs="true">
                                <option value="">Pilih Provinsi</option>
                                <?php if (!empty($provinsi)) {
                                    foreach ($provinsi as $key => $value) {
                                ?>
                                <option value="<?php echo $value->id ?>">
                                    <?php echo $value->name; ?>
                                </option>
                                <?php }}?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kota / Kabupaten</label>
                            <select class="form-control kabupaten-id" id="kabupaten_id" name="kabupaten_id" placeholder="Kota / Kabupaten" data-selectjs="true">
                                <option value="">Pilih Kota / Kabupaten</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kecamatan</label>
                            <select class="form-control kecamatan-id" id="kecamatan_id" name="kecamatan_id" placeholder="Kecamatan" data-selectjs="true">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelurahan</label>
                            <select class="form-control kelurahan-id" id="kelurahan_id" name="kelurahan_id" placeholder="Kelurahan" data-selectjs="true">
                                <option value="">Pilih Kelurahan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control text-only" id="address" placeholder="Alamat" name="address" rows="9"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Hak Akses</label>
                            <select class="form-control" id="role_id" name="role_id" placeholder="Hak Akses" data-selectjs="true">
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
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control text-nospace" id="username" placeholder="Username" name="username" value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control " id="password" placeholder="Password" name="password" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control " id="password_confirm" placeholder="Konfirmasi Password" name="password_confirm" value="">
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer text-right">
            <a href="<?php echo base_url('user'); ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" name="simpan" class="btn btn-primary ms-auto">Simpan</button>
        </div>
    </form>
</div>

<script data-main="<?php echo base_url() ?>assets/js/main/main-user" src="<?php echo base_url() ?>assets/js/require.js"></script>