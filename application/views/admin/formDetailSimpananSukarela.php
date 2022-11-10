<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">  
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="myTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th> 
                            <th>NIK</th>
                            <th>Nama Anggota</th>
                            <th>Pengeluaran/Pemasukan</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($anggota as $data) {
                    
                        ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $data->nik ?></td>
                            <td><?= $data->nama_anggota ?></td>
                            <?php if($data->jenis_simpanan == "pemasukan"){ ?>
                                <td><span class="badge badge-success px-4 py-2">Pemasukan</span></td>
                            <?php }else{ ?>
                                <td><span class="badge badge-danger px-4 py-2">Pengeluaran</span></td>
                            <?php } ?>
                            <td><?= "Rp " . number_format($data->jumlah,0,',','.'); ?></td>
                            <td><?= date('d - M - Y', strtotime($data->tanggal)) ?></td>
                            <td>
                                <center>
                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/simpananSukarela/updateData/'. $data->id_simpanan_tabungan) ?>"><i class="fas fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/simpananSukarela/deleteData/'. $data->id_simpanan_tabungan) ?>"><i class="fas fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>
                        <?php } ?>
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