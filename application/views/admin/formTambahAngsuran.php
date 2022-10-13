<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card"  style="width: 60%; margin-bottom:100px">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('admin/pinjaman/tambahAngsuranAksi') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id_pinjaman" id="id_pinjaman" value="<?php echo $pinjaman->id; ?>">
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
                    <label>Nomor Angsuran</label>
                    <input type="text" name="no_angsuran" class="form-control">
                    <?php echo form_error('no_angsuran', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Jumlah Angsuran</label>
                    <input type="number" name="jumlah_angsuran" class="form-control">
                    <?php echo form_error('jumlah_angsuran', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" class="form-control">
                    <?php echo form_error('tanggal_bayar', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            
            </form>

        </div>
    </div>

</div>