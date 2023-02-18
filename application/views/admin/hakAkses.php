<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card"  style="margin-bottom:100px">
        <div class="card-body">
            <form method="POST" action="<?php echo base_url('dataJabatan/updateHakAkses') ?>" enctype="multipart/form-data">
                <input type="hidden" name="id_jabatan" id="id_jabatan" value="<?php echo $jabatan->id_jabatan; ?>">
                <div class="form-group">
                    <label>Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" readonly class="form-control" value="<?php echo $jabatan->nama_jabatan ?>">
                    <?php echo form_error('nama_jabatan', '<div class="text-small text-danger"> </div>') ?>
                </div>
                
                <div class="table-responsive">
                    <table class="table card-table table-striped table-hover table-vcenter text-nowrap responsive datatable w-100" id="tabhakakses">
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
                                        <input class="form-check- mt-1 cb-element" type="checkbox" name="menus[]" onchange="onChangeElement()"
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
                                            <input type="checkbox" class="form-check-input mr-1 cb-element-child function-<?php echo $k; ?>"
                                            name="functions[<?php echo $key; ?>][]"
                                            value="<?php echo $k; ?>" onchange="onChangeChild()"
                                            <?php if(!empty($hak_akses[$key][$k])){ echo $hak_akses[$key][$k]; } ?>
                                            >
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

<script>
    $(".cb-element-child").trigger("change");

    $("#checkAll").change(function () {
        $("input:checkbox.cb-element").prop('checked', $(this).prop("checked"));
        $("input:checkbox.cb-element-child").prop('checked', $(this).prop("checked"));
    });

    $('.cb-element-child').on('click', function(){
        parent = $(this).closest('.function-parent');
        var checked = $(this).is(':checked') ? true : false;

        if ($(this).val() != 1)
        {
            parent.find('.function-1').prop('checked', true);
        }else{
            if(!checked){
                parent.find('.function-2').prop('checked', false);
                parent.find('.function-3').prop('checked', false);
                parent.find('.function-4').prop('checked', false);
                parent.find('.function-5').prop('checked', false);
                parent.find('.function-6').prop('checked', false);
                parent.find('.function-7').prop('checked', false);
            }
        }
    });

    function onChangeChild() {
        $("#tabhakakses tbody").on('change', '.cb-element-child', function () {
            $parent = $(this).closest("tr").find(".cb-element");
            $child = $(this).closest("tr").find(".cb-element-child");
            $childChecked = $(this).closest("tr").find(".cb-element-child:checked");

            _tot = $child.length
            _tot_checked = $childChecked.length;
            if (_tot_checked < 1) {
                $parent.prop('checked', false);
            } else {
                $parent.prop('checked', true);
            }
            checkAllCheckbox();
        });
    }

    function onChangeElement() {
        $("#tabhakakses tbody").on('change', '.cb-element', function () {
            checkAllCheckbox();
            $parent = $(this).closest("tr").find(".cb-element-child");
            $parent.prop('checked', $(this).prop("checked"));
        });
    }

    function checkAllCheckbox(){
        _tot = $(".cb-element").length
        _tot_checked = $(".cb-element:checked").length;
        if(_tot != _tot_checked){
            $("#checkAll").prop('checked',false);
        }else{
            $("#checkAll").prop('checked',true);
        }
    }
</script>