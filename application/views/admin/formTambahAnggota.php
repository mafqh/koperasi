<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card"  style="width: 60%; margin-bottom:100px">
        <div class="card-body">

            <form method="POST" action="<?php echo base_url('admin/dataAnggota/tambahDataAksi') ?>" enctype="multipart/form-data">
            

                <div class="form-group">
                    <label>No. Anggota</label>
                    <input type="number" name="nik" class="form-control">
                    <?php echo form_error('nik', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Nama Anggota</label>
                    <input type="text" name="nama_anggota" class="form-control">
                    <?php echo form_error('nama_anggota', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat_anggota" class="form-control">
                    <?php echo form_error('alamat_anggota', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="no_telp" class="form-control">
                    <?php echo form_error('no_telp', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                    <?php echo form_error('username', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <?php echo form_error('nama_anggota', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Jenis kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control">
                    <?php echo form_error('tanggal_masuk', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="">--Pilih Status--</option>
                        <option value="4">Anggota Internal</option>
                        <option value="5">Anggota Eksternal</option>
                    </select>
                    <?php echo form_error('status', '<div class="text-small text-danger"> </div>') ?>
                </div>

                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control">
                    <?php echo form_error('photo', '<div class="text-small text-danger"></div>') ?>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            
            </form>

        </div>
    </div>

</div>