<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Hak Akses</h1>
</div>

<div class="card shadow mb-4">
    <form class="modal-content" id="form" method="POST" action="" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="role_id" id="role_id" value="<?php echo $role->id; ?>">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Ubah Hak Akses <?php echo $role->name; ?></h6>
        </div>
        <div class="card-body">
            <table class="table" id="tabcloud">
                <thead>
                    <tr>
                        <th style="width: 5%">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="checkAllCloud">
                                <label class="form-check-label" for="checkAllCloud">
                                    
                                </label>
                            </div>
                        </th>
                        <th>Menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $warna = ["blue", "lime", "orange", "teal", "red", "purple", "pink", "azure", "green", "indigo", "yellow", "cyan"];
                    $menu = "";
                    foreach ($privilege as $key => $value) {
                        $menu .= '<tr>';
                        //checkbox
                        $menu .= '<td class="valign-mid">';
                        $menu .= '<label class="form-check">';
                        $menu .= '<input class="form-check-input cb-element-cloud" type="checkbox" name="menus[]"';
                        $menu .= 'onchange="App.onChangeElement()" value="'.$value->id.'" '.$value->checked .' >';
                        $menu .= '<label>';
                        $menu .= '</td>';

                        //name
                        $menu .= '<td>';
                        $menu .= '<div class="form-label">'.$value->name .'</div>';
                        $menu .= '<div class="function-parent text-wrap">';
                        foreach ($value->fungsi as $k => $v) {
                            $menu .= '<label class="form-check form-check-inline">';
                            $menu .= '<input type="checkbox" class="form-check-input cb-element-cloud-child function-'.$v->id .'"';
                            $menu .= 'name="functions['.$value->id .'][]" onchange="App.onChangeChild()"';
                            $menu .= 'value="'.$v->id .'"  '.$v->checked .' >';
                            $menu .= '<span class="form-check-label text-'.$warna[($v->id - 1)] .'">'.$v->name .'</span>';
                            $menu .= '</label>';
                        }
                        $menu .= '</div>';
                        $menu .= '</td>';

                        $menu .= '</tr>';
                    }

                    echo $menu;
                    ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-right">
            <a href="<?php echo base_url('role'); ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" name="simpan" class="btn btn-primary ms-auto">Simpan</button>
        </div>
    </form>
</div>

<script data-main="<?php echo base_url() ?>assets/js/main/main-role" src="<?php echo base_url() ?>assets/js/require.js"></script>