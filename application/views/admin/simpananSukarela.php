<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

        <!-- Begin Page Content -->
    <table class="table table-striped table-bordered" id="myTable">
        <thead>
            <th class="text-centre">No</th>
            <th class="text-centre">NIK</th>
            <th class="text-centre">Nama Anggota</th>
            <th class="text-centre">Jenis Kelamin</th>
            <th class="text-centre">Tanggal Masuk</th>
            <th class="text-centre">Status</th>
            <th class="text-centre">Photo</th>
            <th class="text-centre">Hak Akses</th>
            <th class="text-centre">Action</th>
        </thead>
        
        <tbody>
            <?php $no=1;
            $jenis_simpanan = $this->uri->segment(4);
            foreach($jenis as $a) : ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $a->nik ?></td>
                    <td><?php echo $a->nama_anggota ?></td>
                    <td><?php echo $a->jenis_kelamin ?></td>
                    <td><?php echo $a->tanggal_masuk ?></td>
                    <td><?php echo $a->status ?></td>
                    <td><img src="<?php echo base_url(). 'assets/photo/'. $a->photo ?>" width="75px" ></td>
                    
                        <?php if($a->hak_akses=='1') { ?>
                            <td>Admin</td>
                        <?php }else{ ?>
                            <td>Anggota</td>
                        <?php } ?>
                    
                    <td>
                        <center>
                            <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/simpananPokok/tambahSimpananPokok/'. $jenis_simpanan .'/'. $a->id_anggota) ?>"><i class="fas fa-plus"></i> Simpanan Sukarela</a>
    
                            <a class="btn btn-sm btn-success" href="<?php echo base_url('admin/simpananPokok/detailSimpananPokok/'. $jenis_simpanan .'/'. $a->id_anggota) ?>">Detail Simpanan Sukarela</a>
                        </center>
                    </td>
    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>