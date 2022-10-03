<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>
</div>

<div class="card shadow mb-4">
    <form class="modal-content" id="form-password" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $users->id; ?>">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Password Lama</label>
                <input type="password" class="form-control" name="old_password" id="old_password" autocomplete="off" placeholder="Password">
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" class="form-control" name="new_password" id="new_password" autocomplete="off" placeholder="Password">
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="off" placeholder="Konfirmasi Password">
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" name="simpan" class="btn btn-primary ms-auto">Simpan</button>
        </div>
    </form>
</div>

<script data-main="<?php echo base_url() ?>assets/js/main/main-profile" src="<?php echo base_url() ?>assets/js/require.js"></script>