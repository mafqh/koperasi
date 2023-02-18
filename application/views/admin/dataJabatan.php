<div class="container-fluid" style="margin-buttom: 100px">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('pesan') ?>

                    <table class="table table-striped table-bordered" id="myTable">
                        <thead>
                            <th class="text-centre">No</th>
                            <th class="text-centre">Nama Jabatan</th>
                            <th class="text-centre">Pengurus</th>
                            <th class="text-centre">Action</th>
                        </thead>
                        <tbody>
                        <?php 
                            $no=1; 
                            foreach($jabatan as $a) : 
                        ?>
                            <?php 
                                $pengurus = "Ya";
                                if($a->is_pengurus == 0){
                                    $pengurus = "Tidak";
                                }
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $a->nama_jabatan ?></td>
                                <td><?php echo $pengurus ?></td>                                
                                <td>
                                    <center>
                                        <?php if($is_can_hak_akses){ ?>
                                            <a class="btn btn-sm btn-success" href="<?php echo base_url('dataJabatan/hakAkses/'. $a->id_jabatan) ?>"><i class="fas fa-key"></i></a>
                                        <?php } ?>
                                    </center>
                                </td>
                
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>