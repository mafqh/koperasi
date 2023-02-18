<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card" style="margin-bottom: 120px; width: 65%">
        <div class="card-header font-weight-bold bg-primary text-white">
            Data Anggota
        </div>

        <?php foreach($anggota as $a) : ?>

            <?php 
            $jabatan = '';
            if($a->status==2){
                $jabatan = 'Ketua';
            }else if($a->status==3){
                 $jabatan = 'Sekretaris';
            }else if($a->status==4){
                 $jabatan = 'Bendahara';
            }else if($a->status==5){
                 $jabatan = 'Anggota Internal';
            }else if($a->status==6){
                 $jabatan = 'Anggota Eksternal';
            }
        
                ?>

        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <img style="width: 250px" src="<?php echo base_url('assets/photo/'.$a->photo) ?>">
                </div>
            
                <div class="col-md-7">
                    <table class="table">
                        <tr>
                            <td>No. Anggota</td>
                            <td>:</td>
                            <td><?php echo $a->nik ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pengurus</td>
                            <td>:</td>
                            <td><?php echo $a->nama_anggota ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td><?php echo $a->username ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?php echo $jabatan ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Masuk</td>
                            <td>:</td>
                            <td><?php echo date('d - M - Y', strtotime($a->tanggal_masuk)) ?></td>
                        </tr>
                        <tr>
                            <td>Alamat Anggota</td>
                            <td>:</td>
                            <td><?php echo $a->alamat_anggota ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?php echo $a->jenis_kelamin ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Telepon</td>
                            <td>:</td>
                            <td><?php echo $a->no_telp ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <?php endforeach; ?>

    </div>

</div>