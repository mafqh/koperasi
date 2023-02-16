<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card"  style="margin-bottom:100px">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('admin/dataJabatan/updateHakAkses') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id_jabatan" id="id_jabatan" value="<?php echo $jabatan->id_jabatan; ?>">
                <div class="form-group">
                    <label>Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" readonly class="form-control" value="<?php echo $jabatan->nama_jabatan ?>">
                    <?php echo form_error('nama_jabatan', '<div class="text-small text-danger"> </div>') ?>
                </div>
                
                <div class="table-responsive">
                    <table class="table card-table table-striped table-hover table-vcenter text-nowrap responsive datatable w-100" id="tabweb">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%">
                                    <label class="form-check">
                                        <input class="form-check" type="checkbox" id="checkAll">
                                    </label>
                                </th>
                                <th style="width: 30%">Nama Menu</th>
                                <th style="width: 65%">Aktif Fungsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menus as $key => $value) { ?>
                            <tr>
                                <td class="valign-mid">
                                    <label class="form-check">
                                        <input class="form-check- mt-1 cb-element" type="checkbox" name="menus[]"
                                        value="<?php echo $key; ?>">
                                    </label>
                                </td>
                                <td>
                                    <?php echo $value; ?>
                                </td>
                                <td>
                                    <div class="function-parent d-flex">
                                        <?php 
                                            foreach ($fungsi as $k => $v) { 
                                                if(in_array($k, $privilege[$key])){
                                        ?>
                                        <label class="form-check mr-4">
                                            <input type="checkbox" class="form-check-input mr-1 cb-element-child function-1"
                                            name="functions[<?php echo $key; ?>][]"
                                            value="<?php echo $k; ?>">
                                            <?php echo $v; ?>
                                        </label>
                                        <?php } } ?>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>            
            </form>
        </div>
    </div>

</div>