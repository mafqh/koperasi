<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card"  style="width: 60%; margin-bottom:100px">
        <div class="card-body">

        <?php foreach ($jabatan as $a) : ?>

            <form method="POST" action="<?php echo base_url('admin/dataJabatan/updateDataAksi') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id_jabatan" id="id_jabatan" value="<?php echo $a->id_jabatan; ?>">
                <div class="form-group">
                    <label>Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" class="form-control" value="<?php echo $a->nama_jabatan ?>">
                    <?php echo form_error('nama_jabatan', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Pengurus</label>
                    <select name="is_pengurus" class="form-control">
                        <option>-- Ya/Tidak --</option>
                        <option <?php if($a->is_pengurus == 1){ echo "selected"; } ?> value="1">Ya</option>
                        <option <?php if($a->is_pengurus == 0){ echo "selected"; } ?> value="0">Tidak</option>
                    </select>
                    <?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            
            </form>

            <?php endforeach; ?>

        </div>
    </div>

</div>