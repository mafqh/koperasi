<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <?php echo $this->session->flashdata('pesan') ?>
    <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('anggota/simpananPokok/tambahSimpananPokok') ?>"><i class="fas fa-plus"></i> Biaya Administrasi</a>

        <!-- Begin Page Content -->
    <table class="table table-striped table-bordered" id="myTable">
        <tr>
            <th class="text-centre">No</th>
            <th class="text-centre">Tanggal</th>
            <th class="text-centre">Jumlah</th>
            <th class="text-centre">Bukti Transfer</th>
            <th class="text-centre">Status Konfirmasi</th>
        </tr>
        
        <?php $i=1; ?>
        <?php foreach ($simpanan_pokok as $sp) :?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $sp->tanggal ?></td> 
                <td><?= $sp->jumlah ?></td>
                <td><?= "Bukti Transfer" ?></td>           
                <td>
                    <center>
                        <?php if($sp->status==1) : ?>
                        <a class="btn btn-sm btn-success" href=""><i class="fas fa-check"></i> Diterima</a>
                            <?php else: ?>
                        <a class="btn btn-sm btn-warning" href=""><i class="fas"></i> Memproses</a>
                                <?php endif; ?>
                    </center>
                </td>
            </tr>
            <?php $i++; ?>
            <?php endforeach;?>
    </table>

</div>