<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>


<table class="table table-striped table-bordered">
<thead>
    <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nama Anggota</th>
        <th>Jenis Kelamin</th>
        <th>Jumlah</th>
        <th>Tanggal Bayar</th>
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
        <td><?= $data->jenis_kelamin ?></td>
        <td><?= "Rp " . number_format($data->jumlah,0,',','.'); ?></td>
        <td><?= date('d - M - Y', strtotime($data->tanggal)) ?></td>
        <td>tombol</td>

    </tr>
    <?php } ?>
</tbody>

</table>




</div>