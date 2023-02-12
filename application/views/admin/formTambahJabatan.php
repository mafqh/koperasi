<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card"  style="width: 60%; margin-bottom:100px">
        <div class="card-body">

            <form method="POST" action="<?php echo base_url('admin/dataJabatan/tambahDataAksi') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" class="form-control">
                    <?php echo form_error('nama_jabatan', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Pengurus</label>
                    <select name="is_pengurus" class="form-control">
                        <option value="">-- Ya/Tidak --</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                    <?php echo form_error('is_pengurus', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            
            </form>

        </div>
    </div>

</div>