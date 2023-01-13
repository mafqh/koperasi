<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card"  style="width: 60%; margin-bottom:100px">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('admin/pinjaman/updateDataAksi') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?php echo $pinjaman->id; ?>">
                <div class="form-group">
                    <label>No. Anggota</label>
                    <input type="number" name="nik" class="form-control" value="<?php echo $anggota->nik; ?>" readonly>
                    <?php echo form_error('nik', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Nama Anggota</label>
                    <input type="text" name="nama_anggota" class="form-control" value="<?php echo $anggota->nama_anggota; ?>" readonly>
                    <?php echo form_error('nama_anggota', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Nomor Pinjaman</label>
                    <input type="text" name="no_pinjaman" class="form-control" value="<?php echo $pinjaman->no_pinjaman; ?>" readonly>
                    <?php echo form_error('no_pinjaman', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Jumlah Pinjaman</label>
                    <input type="number" name="jumlah_pinjaman" class="form-control" value="<?php echo $pinjaman->jumlah_pinjaman; ?>" required>
                    <?php echo form_error('jumlah_pinjaman', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Tanggal Pinjaman</label>
                    <input type="date" name="tanggal_pinjaman" class="form-control" value="<?php echo $pinjaman->tanggal_pinjaman; ?>" required>
                    <?php echo form_error('tanggal_pinjaman', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Lama Pinjaman</label>
                    <input type="number" name="lama" class="form-control" value="<?php echo $pinjaman->lama; ?>" required>
                    <?php echo form_error('lama', '<div class="text-small text-danger"> </div>') ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            
            </form>

        </div>
    </div>

</div>