<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

        <!-- Begin Page Content -->
    <table class="table table-striped table-bordered" id="myTable">
        <thead>
            <th class="text-centre">No</th>
            <th class="text-centre">No. Anggota</th>
            <th class="text-centre">Nama Anggota</th>
            <th class="text-centre">Total Tabungan</th>
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
                    <td><?php echo "Rp " . number_format($a->total,0,',','.'); ?></td>
                    <td>
                        <center>
                            <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/simpananSukarela/tambahSimpananSukarela/'. $a->id_anggota) ?>"><i class="fas fa-plus"></i> Tabungan</a>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url('admin/simpananSukarela/tambahSimpananSukarela/'. $a->id_anggota) ?>"><i class="fas fa-minus"></i> Tabungan</a>
    
                            <a class="btn btn-sm btn-success" href="<?php echo base_url('admin/simpananSukarela/detailSimpananSukarela/'. $a->id_anggota) ?>">Detail Simpanan Tabungan</a>
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