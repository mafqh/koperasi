define([
    "jQuery",
    "sbadmin",
    "jqueryEasing",
    "bootstrap4",
    "toastr",
    "jValidate",
    "datatablesBootstrap",
    "select2",
], function(
    $,
    sbadmin,
    jqueryEasing,
    bootstrap4,
    toastr,
    jValidate,
    datatablesBootstrap,
    select2,
) {
    return {
        table: null,
        init: function() {
            App.initFunc();
            App.initEvent();
            App.initSelect2();
            App.initTable();
            App.initTableClick();
            App.clearData();
            App.initForm();
            App.onChangeWilayah();
        },
        initEvent: function() {
            $("#photo").on("change", function() {
                var files = !!this.files ? this.files : [];

                if (!files.length || !window.FileReader) return;

                if (/^image/.test(files[0].type)) {
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function() {
                        $("#img_preview").attr("src", this.result);
                    }
                }
            });
        },
        initSelect2: function() {
            $('*select[data-selectjs="true"]').select2({ width: '100%' });
        },
        initTable: function() {
            App.table = $('#table').DataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "searching": true,
                "responsive": true,
                "language": {
                    "search": "Cari",
                    "lengthMenu": "Lihat _MENU_ data",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan _START_ s/d _END_ dari total _TOTAL_ data",
                    "infoEmpty": "Tidak ada data di dalam tabel",
                    "infoFiltered": "(cari dari _MAX_ total data)",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                },
                "order": [
                    [0, "asc"]
                ],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": App.baseUrl + "user/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "nama" },
                    { "data": "username" },
                    { "data": "kontak" },
                    { "data": "is_deleted" },
                    { "data": "action", "orderable": false },
                ],
            });
        },
        initTableClick: function() {
            $('#table tbody').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                        url: App.baseUrl + 'user/getUser',
                        type: 'GET',
                        data: {
                            id: id
                        },
                    })
                    .done(function(response) {
                        var data = JSON.parse(response);

                        $('#modal-title-edit').text(data.data.first_name);
                        $('#id_edit').val(data.data.id);
                        $('#kode_edit').val(data.data.kode);

                        $('#first_name_edit').val(data.data.first_name);
                        $('#email_edit').val(data.data.email);
                        $('#phone_edit').val(data.data.phone);
                        $('#nik_edit').val(data.data.nik);

                        $('#photo_old_edit').val(data.data.photo);
                        if (data.data.photo) {
                            $('#img_preview_edit').attr("src", App.baseUrl + 'uploaded/profile/' + data.data.kode + '/' + data.data.photo);
                        }

                        $('#role_id_edit').val(data.data.role_id).trigger("change");

                        $('#perangkat_daerah_id_edit').val(data.data.perangkat_daerah_id).trigger("change");
                        $('#nip_edit').val(data.data.nip);
                        $('#jabatan_edit').val(data.data.jabatan);
                        $('#golongan_id_edit').val(data.data.golongan_id).trigger("change");

                        $('#address_edit').val(data.data.address);

                        var option_provinsi = "<option value='' disabled selected>Pilih Provinsi</option>";
                        var option_kabupaten = "<option value='' disabled selected>Pilih Kota / Kabupaten</option>";
                        var option_kecamatan = "<option value='' disabled selected>Pilih Kecamatan</option>";
                        var option_kelurahan = "<option value='' disabled selected>Pilih Kelurahan / Desa</option>";
                        $('.provinsi-id').html(option_provinsi);
                        $('.kabupaten-id').html(option_kabupaten);
                        $('.kecamatan-id').html(option_kecamatan);
                        $('.kelurahan-id').html(option_kelurahan);

                        for (var i = 0; i < data.provinsi.length; i++) {
                            option_provinsi += "<option value='" + data.provinsi[i].id + "' " + data.provinsi[i].selected + ">" + data.provinsi[i].name + "</option>";
                        }
                        $('#provinsi_id_edit').html(option_provinsi);
                        $("#provinsi_id_edit").select2({ disabled: 'readonly', width: '100%' });

                        for (var i = 0; i < data.kabupaten.length; i++) {
                            option_kabupaten += "<option value='" + data.kabupaten[i].id + "' " + data.kabupaten[i].selected + ">" + data.kabupaten[i].name + "</option>";
                        }
                        $('#kabupaten_id_edit').html(option_kabupaten);

                        for (var i = 0; i < data.kecamatan.length; i++) {
                            option_kecamatan += "<option value='" + data.kecamatan[i].id + "' " + data.kecamatan[i].selected + ">" + data.kecamatan[i].name + "</option>";
                        }
                        $('#kecamatan_id_edit').html(option_kecamatan);

                        for (var i = 0; i < data.kelurahan.length; i++) {
                            option_kelurahan += "<option value='" + data.kelurahan[i].id + "' " + data.kelurahan[i].selected + ">" + data.kelurahan[i].name + "</option>";
                        }
                        $('#kelurahan_id_edit').html(option_kelurahan);

                        $('#modal_edit').modal('show');
                    })
                    .fail(function() {
                        console.log("error");
                    });
            });


            $('#table tbody').on('click', '.delete', function() {
                var url = $(this).attr("url");
                var status = $(this).attr("data-status");
                var pesan = "";
                if (status == 1) {
                    pesan = "Apakah anda yakin ingin menonaktifkan data ini?";
                } else if (status == 2) {
                    pesan = "Apakah anda yakin ingin mengaktifkan data ini?";
                } else if (status == 3) {
                    pesan = "Apakah anda yakin ingin menghapus data ini?";
                }
                App.confirm(pesan, function() {
                    $.ajax({
                        method: "GET",
                        url: url
                    }).done(function(msg) {
                        var data = JSON.parse(msg);
                        if (data.status == false) {
                            toastr.error(data.msg);
                        } else {
                            toastr.success(data.msg);
                            App.table.ajax.reload(null, true);
                        }
                    });
                })
            });
        },
        clearData: function() {
            $('#new_data').on('click', function(event) {
                $("#form-create")[0].reset();
                $("#form-create select").val("").trigger('change');
                $("#form-create #img_preview").attr("src", "");

                var kabupaten_id = $('#provinsi_id_selected').val();
                $("#form-create select.provinsi-id").val(kabupaten_id).trigger('change').select2({ disabled: 'readonly', width: '100%' });
                App.onChangeWilayah();
            });
        },
        initForm: function() {
            if ($("#form").length > 0) {
                $("#form").validate({
                    rules: {
                        first_name: {
                            required: true,
                        },
                        nik: {
                            required: true,
                            number: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        phone: {
                            required: true,
                            number: true
                        },
                        provinsi_id: {
                            required: true,
                        },
                        kabupaten_id: {
                            required: true,
                        },
                        kecamatan_id: {
                            required: true,
                        },
                        kelurahan_id: {
                            required: true,
                        },
                        address: {
                            required: true,
                        },
                        nip: {
                            required: true,
                            number: true
                        },
                        role_id: {
                            required: true,
                        },
                        username: {
                            required: true,
                            remote: {
                                url: App.baseUrl + "/user/checkUsername",
                                type: "post",
                                data: {
                                    username: function() {
                                        return $("#username").val();
                                    }
                                }
                            }
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirm: {
                            required: true,
                            minlength: 8,
                            equalTo: "#password"
                        },
                    },
                    messages: {
                        first_name: {
                            required: $('#first_name').attr('placeholder') + ' Harus Diisi',
                        },
                        nik: {
                            required: $('#nik').attr('placeholder') + ' Harus Diisi',
                            number: $('#nik').attr('placeholder') + ' Harus Angka',
                        },
                        email: {
                            required: $('#email').attr('placeholder') + ' Harus Diisi',
                            email: $('#email').attr('placeholder') + ' Tidak Benar',
                        },
                        phone: {
                            required: $('#phone').attr('placeholder') + ' Harus Diisi',
                            number: $('#phone').attr('placeholder') + ' Harus Angka',
                        },
                        provinsi_id: {
                            required: $('#provinsi_id').attr('placeholder') + ' Harus Dipilih',
                        },
                        kabupaten_id: {
                            required: $('#kabupaten_id').attr('placeholder') + ' Harus Dipilih',
                        },
                        kecamatan_id: {
                            required: $('#kecamatan_id').attr('placeholder') + ' Harus Dipilih',
                        },
                        kelurahan_id: {
                            required: $('#kelurahan_id').attr('placeholder') + ' Harus Dipilih',
                        },
                        address: {
                            required: $('#address').attr('placeholder') + ' Harus Diisi',
                        },
                        nip: {
                            required: $('#nip').attr('placeholder') + ' Harus Diisi',
                            number: $('#nip').attr('placeholder') + ' Harus Angka',
                        },
                        role_id: {
                            required: $('#role_id').attr('placeholder') + ' Harus Dipilih',
                        },
                        username: {
                            required: $('#username').attr('placeholder') + ' Harus Diisi',
                            remote: $('#username').attr('placeholder') + ' Sudah Digunakan',
                        },
                        password: {
                            required: $('#password').attr('placeholder') + ' Harus Diisi',
                            minlength: $('#password').attr('placeholder') + ' Minimal 8 Karakter',
                        },
                        password_confirm: {
                            required: $('#password_confirm').attr('placeholder') + ' Harus Diisi',
                            minlength: $('#password_confirm').attr('placeholder') + ' Minimal 8 Karakter',
                            equalTo: $('#password').attr('placeholder') + ' dan ' + $('#password_confirm').attr('placeholder') + ' Tidak Sama',
                        },
                    },
                    debug: true,
                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        // Add the `invalid-feedback` class to the error element
                        element.removeClass( "error" );
                        error.addClass( "invalid-feedback" );
                        if ( element.prop( "type" ) === "select-one" ) {
                            error.appendTo(element.parent());
                        }else if ( element.prop( "type" ) === "select-multiple" ) {
                            error.appendTo(element.parent());
                        }else if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertBefore( element.next( "label" ) );
                        } else if ( element.prop( "type" ) === "radio" ) {
                            error.appendTo( element.parent().parent().parent());
                        } else if ( element.attr( "aria-describedby" ) === "basic-group-left" ) {
                            error.insertBefore( element.parent() );
                        } else {
                            error.insertAfter( element );
                        }
                    },
                    submitHandler: function(form) {
                        form.submit();
                        return false;
                    }
                });
            }
        },

        formDataChangeProvinsi: function(provinsi_id) {
            $.ajax({
                    url: App.baseUrl + 'wilayah/getKabupaten',
                    type: 'GET',
                    data: { id: provinsi_id },
                })
                .done(function(response) {
                    var data = JSON.parse(response);
                    var option_kabupaten = "<option value='' disabled selected>Pilih Kota / Kabupaten</option>";
                    var option_kecamatan = "<option value='' disabled selected>Pilih Kecamatan</option>";
                    var option_kelurahan = "<option value='' disabled selected>Pilih Kelurahan / Desa</option>";
                    $('.kabupaten-id').html(option_kabupaten);
                    $('.kecamatan-id').html(option_kecamatan);
                    $('.kelurahan-id').html(option_kelurahan);

                    if (data.status == true) {
                        for (var i = 0; i < data.data.length; i++) {
                            option_kabupaten += "<option value=" + data.data[i].id + "> " + data.data[i].name + "</option>";
                        }
                    }
                    $('.kabupaten-id').html(option_kabupaten);
                    $('.kabupaten-id').val($("#kabupaten_id_selected").val()).trigger("change");
                })
                .fail(function() {
                    console.log("error");
                });
        },

        onChangeWilayah: function() {
            var provinsi_id = $('.provinsi-id').val();
            if (provinsi_id === null) {
                $('.provinsi-id').on('select2:select', function() {
                    App.formDataChangeProvinsi($(this).val());
                });
            } else {
                App.formDataChangeProvinsi(provinsi_id);
            }

            $('.kabupaten-id').on('change', function() {
                var kabupaten_id = $(this).val();
                $.ajax({
                        url: App.baseUrl + 'wilayah/getKecamatan',
                        type: 'GET',
                        data: { id: kabupaten_id },
                    })
                    .done(function(response) {
                        var data = JSON.parse(response);
                        var option_kecamatan = "<option value='' disabled selected>Pilih Kecamatan</option>";
                        var option_kelurahan = "<option value='' disabled selected>Pilih Kelurahan / Desa</option>";
                        $('.kecamatan-id').html(option_kecamatan);
                        $('.kelurahan-id').html(option_kelurahan);

                        if (data.status == true) {
                            for (var i = 0; i < data.data.length; i++) {
                                option_kecamatan += "<option value=" + data.data[i].id + "> " + data.data[i].name + "</option>";
                            }
                        }
                        $('.kecamatan-id').html(option_kecamatan);
                    })
                    .fail(function() {
                        console.log("error");
                    });
            });

            $('.kecamatan-id').on('change', function() {
                var kecamatan_id = $(this).val();
                $.ajax({
                        url: App.baseUrl + 'wilayah/getKelurahan',
                        type: 'GET',
                        data: { id: kecamatan_id },
                    })
                    .done(function(response) {
                        var data = JSON.parse(response);
                        var option_kelurahan = "<option value='' disabled selected>Pilih Kelurahan / Desa</option>";
                        $('.kelurahan-id').html(option_kelurahan);

                        if (data.status == true) {
                            for (var i = 0; i < data.data.length; i++) {
                                option_kelurahan += "<option value=" + data.data[i].id + "> " + data.data[i].name + "</option>";
                            }
                        }
                        $('.kelurahan-id').html(option_kelurahan);
                    })
                    .fail(function() {
                        console.log("error");
                    });
            });
        }
    }
});