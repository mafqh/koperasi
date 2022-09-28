<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

        <!-- Begin Page Content -->
    <table class="table table-striped table-bordered" id="myTable">
        <tr>
            <th class="text-centre">No</th>
            <th class="text-centre">No. Anggota</th>
            <th class="text-centre">Nama Anggota</th>
            <th class="text-centre">Bukti Transfer</th>
            <th class="text-centre">Nominal</th>
            <th class="text-centre">Action</th>
        </tr>
        

        <?php $no=1;
        $jenis_simpanan = $this->uri->segment(4);
        foreach($jenis as $a) : ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $a->nik ?></td>
                <td><?php echo $a->nama_anggota ?></td>
                <td>belum</td>
                <td>belum</td>
                <td>
                    <center>
                        <a class="btn btn-sm btn-success" href="<?php echo base_url(''. $jenis_simpanan .'/'. $a->id_anggota) ?>"><i></i>Diterima</a>

                        <a class="btn btn-sm btn-danger" href="<?php echo base_url(''. $jenis_simpanan .'/'. $a->id_anggota) ?>">Ditolak</a>
                    </center>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>

</div>