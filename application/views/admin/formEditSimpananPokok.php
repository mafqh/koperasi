<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 50%">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('admin/SimpananPokok/update') ?>">

            <?php
            $anggota = $this->uri->segment(4); 
            ?>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="hidden" name="id_simpanan" value="<?php echo $simpanan->id_biaya_administrasi ?>">
                <input type="number" name="jumlah" class="form-control" value="<?php echo $simpanan->jumlah ?>">
                <input type="hidden" name="id_anggota" id="id_anggota" value="<?php echo $simpanan->id_anggota ?>">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <!-- <a href="<?php echo base_url() ?>Admin/SimpananPokok/detailSimpananPokok/<?php echo $simpanan->id_anggota ?>" class="btn btn-danger">Batal</a> -->
            </form>
        </div>
    </div>
</div>