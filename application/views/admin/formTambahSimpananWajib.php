<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 50%">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('admin/SimpananWajib/Tambah') ?>">

            <?php
            $jenis = $this->uri->segment(4);
            $anggota = $this->uri->segment(5); ?>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="hidden" name="jenis_simpanan" value= <?= $jenis ?>  >
                <input type="hidden" name="anggota" value=" <?= $anggota ?> " >
                <input type="number" name="jumlah" class="form-control" placeholder="Masukan jumlah simpanan wajib">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="" class="btn btn-danger">Batal</button>
            </form>
        </div>
    </div>
</div>