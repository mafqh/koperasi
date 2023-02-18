<div class="container-fluid" style="margin-buttom: 100px">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php echo $this->session->flashdata('pesan') ?>
                    <?php if($is_can_create){ ?>
                        <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('dataPengurus/tambahData') ?>"><i class="fas fa-plus"></i> Tambah Pengurus</a>
                    <?php } ?>
                    <table class="table table-striped table-bordered" id="myTable">
                        <thead>
                            <th class="text-centre">No</th>
                            <th class="text-centre">No. Anggota</th>
                            <th class="text-centre">Nama Pengurus</th>
                            <th class="text-centre">Jabatan</th>
                            <th class="text-centre">Tanggal Masuk</th>
                            <th class="text-centre">Photo</th>
                            <th class="text-centre">Hak Akses</th>
                            <th class="text-centre">Action</th>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($pengurus as $p) : ?>
                                <?php 
                                $jabatan = '';
                                if($p->status==1){
                                    $jabatan = 'Ketua';
                                }else if($p->status==2){
                                     $jabatan = 'Sekretaris';
                                }else if($p->status==3){
                                     $jabatan = 'Bendahara';
                                }else if($p->status==4){
                                     $jabatan = 'Anggota Internal';
                                }else if($p->status==5){
                                     $jabatan = 'Anggota Eksternal';
                                }
                            
                                    ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $p->nik ?></td>
                                    <td><?php echo $p->nama_anggota ?></td>
                                    <td><?php echo $jabatan ?></td>
                                    <td><?php echo date('d - M - Y', strtotime($p->tanggal_masuk)) ?></td>
                                    <td><img src="<?php echo base_url(). 'assets/photo/'. $p->photo ?>" width="75px" ></td>
                                    
                                        <?php if($p->hak_akses=='1') { ?>
                                            <td>Admin</td>
                                        <?php }else{ ?>
                                            <td>Pengurus</td>
                                        <?php } ?>
                                    
                                    <td>
                                        <center>
                                            <?php if($is_can_edit){ ?>
                                                <a class="btn btn-sm btn-primary" href="<?php echo base_url('dataPengurus/updateData/'. $p->id_anggota) ?>"><i class="fas fa-edit"></i></a>
                                            <?php } ?>
                                                
                                            <?php if($is_can_delete){ ?>
                                                <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('dataPengurus/deleteData/'. $p->id_anggota) ?>"><i class="fas fa-trash"></i></a>
                                            <?php } ?>
                                            
                                            <?php if($is_can_read){ ?>
                                                <a class="btn btn-sm btn-success" href="<?php echo base_url('dataPengurus/detailPengurus/'. $p->id_anggota) ?>"><i class="fas fa-eye"></i></a>
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

<!-- <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script> -->