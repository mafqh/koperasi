<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">  
                <div class="card-body">
                    <?php echo $this->session->flashdata('pesan') ?>
                    <a class="mb-2 mt-2 btn btn-sm btn-success" href="<?php echo base_url('admin/pinjaman/listAnggota') ?>"><i class="fas fa-plus"></i> Tambah Pinjaman</a>
                    <table class="table table-striped table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pinjaman</th>
                                <th>Nama Anggota</th>
                                <th>Tanggal Pinjam</th>
                                <th>Jumlah Pinjaman</th>
                                <th>Lama Pinjaman</th>
                                <th>Status Peminjaman</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1;
                            foreach($pinjaman as $a) : ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $a->no_pinjaman; ?></td>
                                <td><?php echo $a->nama_anggota; ?></td>
                                <td><?php echo date("d-m-Y", strtotime($a->tanggal_pinjaman)); ?></td>
                                <td><?php echo number_format($a->jumlah_pinjaman); ?></td>
                                <td><?php echo number_format($a->lama); ?></td>
                                <?php if($a->status == "lunas"){ ?>
                                    <td><span class="badge badge-success px-4 py-2">Lunas</span></td>
                                <?php }else{ ?>
                                    <td><span class="badge badge-danger px-4 py-2">Belum Lunas</span></td>
                                <?php } ?>
                                <td>
                                    <center>
                                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/pinjaman/updateData/'. $a->id) ?>"><i class="fas fa-pencil"></i> Edit</a>
                                        <a class="btn btn-sm btn-success" href="<?php echo base_url('admin/pinjaman/detailAngsuran/'. $a->id) ?>">Detail Angsuran</a>
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