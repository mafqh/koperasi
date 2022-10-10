<div class="container-fluid" style="margin-buttom: 100px">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('pesan') ?>
                    <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/dataAnggota/tambahData') ?>"><i class="fas fa-plus"></i> Tambah Anggota</a>
                
                    <table class="table table-striped table-bordered" id="myTable">
                        <thead>
                            <th class="text-centre">No</th>
                            <th class="text-centre">No. Anggota</th>
                            <th class="text-centre">Nama Anggota</th>
                            <th class="text-centre">Tanggal Masuk</th>
                            <th class="text-centre">Status</th>
                            <th class="text-centre">Hak Akses</th>
                            <th class="text-centre">Action</th>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach($anggota as $a) : ?>
                            <?php 
                            $jabatan = '';
                            if($a->status==1){
                                $jabatan = 'Ketua';
                            }else if($a->status==2){
                                 $jabatan = 'Sekretaris';
                            }else if($a->status==3){
                                 $jabatan = 'Bendahara';
                            }else if($a->status==4){
                                 $jabatan = 'Anggota Internal';
                            }else if($a->status==5){
                                 $jabatan = 'Anggota Eksternal';
                            }
                        
                                ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $a->nik ?></td>
                                <td><?php echo $a->nama_anggota ?></td>
                                <td><?php echo date('d - M - Y', strtotime($a->tanggal_masuk)) ?></td>
                                <td><?php echo $jabatan ?></td>
                                
                                    <?php if($a->hak_akses=='1') { ?>
                                        <td>Admin</td>
                                    <?php }else{ ?>
                                        <td>Anggota</td>
                                    <?php } ?>
                                
                                <td>
                                    <center>
                                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/dataAnggota/updateData/'. $a->id_anggota) ?>"><i class="fas fa-edit"></i></a>
                
                                        <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/dataAnggota/deleteData/'. $a->id_anggota) ?>"><i class="fas fa-trash"></i></a>
                
                                        <a class="btn btn-sm btn-success" href="<?php echo base_url('admin/dataAnggota/detailAnggota/'. $a->id_anggota) ?>"><i class="fas fa-eye"></i></a>
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