<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah <?php echo $page_description; ?></h1>
</div>

<div class="card shadow mb-4">
    <form class="modal-content" id="form" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jabatan</h6>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Nama Jabatan</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nama Jabatan">
            </div>
        </div>
        <div class="card-footer text-right">
            <a href="<?php echo base_url('role'); ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" name="simpan" class="btn btn-primary ms-auto">Simpan</button>
        </div>
    </form>
</div>

<script data-main="<?php echo base_url() ?>assets/js/main/main-role" src="<?php echo base_url() ?>assets/js/require.js"></script>