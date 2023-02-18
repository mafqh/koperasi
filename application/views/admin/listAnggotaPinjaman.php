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
                            <th class="text-centre">No. Anggota</th>
                            <th class="text-centre">Nama Anggota</th>
                            <th class="text-centre">Alamat</th>
                            <th class="text-centre">Nomor Telepon</th>
                            <th class="text-centre">Action</th>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach($anggota as $a) : ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $a->nik ?></td>
                                <td><?php echo $a->nama_anggota ?></td>
                                <td><?php echo $a->alamat_anggota ?></td>
                                <td><?php echo $a->no_telp ?></td>  
                                <td>
                                    <center>                
                                        <a class="btn btn-sm btn-success" href="<?php echo base_url('pinjaman/tambahData/'. $a->id_anggota) ?>"><i class="fas fa-plus"></i> Pinjaman</a>
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