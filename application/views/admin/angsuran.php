<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title." ".$pinjaman->no_pinjaman ?><br><small>Pinjaman <?php echo $anggota->nama_anggota ?></small></h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">  
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-info font-weight-bold mb-1">Jumlah angsuran yang sudah dibayar <?= "Rp " . number_format($sudah_dibayar,0,',','.'); ?></div>
                            <div class="alert alert-info font-weight-bold mb-4">Jumlah pinjaman <?= "Rp " . number_format($pinjaman->jumlah_pinjaman,0,',','.'); ?></div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="alert alert-info font-weight-bold mb-1">Jumlah angsuran yang belum dibayar <?= "Rp " . number_format($belum_dibayar,0,',','.'); ?></div>
                            <div class="alert alert-info font-weight-bold mb-4">Angsuran perbulan <?= "Rp " . number_format($pinjaman->jumlah_pinjaman/$pinjaman->lama,0,',','.'); ?></div>
                        </div>
                    </div>

                    <?php if($pinjaman->status == "belum lunas" && $this->session->userdata('hak_akses') == 1){ ?>
                        <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/pinjaman/tambahAngsuran/'.$pinjaman->id) ?>"><i class="fas fa-plus"></i> Tambah Angsuran</a>
                    <?php } ?>
                    <table class="table table-striped table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Angsuran</th>
                                <th>Jumlah Angsuran</th>
                                <th>Tanggal Bayar</th>
                                <?php if($this->session->userdata('hak_akses') == 1){ ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;
                            foreach($angsuran as $a) : ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $a->no_angsuran; ?></td>
                                <td><?php echo number_format($a->jumlah_angsuran,0,',','.'); ?></td>
                                <td><?php echo date("d-m-Y", strtotime($a->tanggal_bayar)); ?></td>
                                <?php if($this->session->userdata('hak_akses') == 1){ ?>
                                <td>
                                    <center>
                                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/pinjaman/updateAngsuran/'. $a->id) ?>"><i class="fas fa-edit"></i></a>
                                        <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/pinjaman/deleteDataAngsuran/'. $a->id) ?>"><i class="fas fa-trash"></i></a>
                                    </center>
                                </td>
                                <?php } ?>
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