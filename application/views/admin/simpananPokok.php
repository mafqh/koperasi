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
            <th class="text-centre">Piutang</th>
            <th class="text-centre">Status Lunas</th>
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
                    <?php 
                        $status = "lunas";
                        $piutang = 0;
                        if($a->total < 200000){
                            $piutang = 200000 - $a->total;
                            $status = "belum lunas";
                        }
                    ?>
                    <td><?php echo "Rp " . number_format($piutang,0,',','.'); ?></td>
                    <?php if($status == "lunas"){ ?>
                        <td><span class="badge badge-success px-4 py-2">Lunas</span></td>
                    <?php }else{ ?>
                        <td><span class="badge badge-danger px-4 py-2">Belum Lunas</span></td>
                    <?php } ?>
                    <td>
                        <?php if($status == "belum lunas" && $this->session->userdata('hak_akses') == 1){ ?>
                            <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/simpananPokok/tambahSimpananPokok/'. $a->id_anggota) ?>"><i class="fas fa-plus"></i> Simpanan Pokok</a>
                        <?php } ?>
                            
                        <?php if($piutang != 200000){ ?>
                            <a class="btn btn-sm btn-success" href="<?php echo base_url('admin/simpananPokok/detailSimpananPokok/'. $a->id_anggota) ?>">Detail Simpanan Pokok</a>
                        <?php } ?>
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