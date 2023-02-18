<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="width: 50%">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('SimpananWajib/update') ?>">

            <?php
            $anggota = $this->uri->segment(3); 
            ?>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="hidden" name="id_simpanan" value="<?php echo $simpanan->id_simpanan_wajib ?>">
                <input type="number" name="jumlah" class="form-control" value="<?php echo $simpanan->jumlah ?>">
                <input type="hidden" name="id_anggota" id="id_anggota" value="<?php echo $simpanan->id_anggota ?>">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>