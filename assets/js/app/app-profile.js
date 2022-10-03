define([
    "jQuery",
    "sbadmin",
    "jqueryEasing",
    "bootstrap4",
    "select2",
    "toastr",
    "jValidate",
], function (
    $,
    sbadmin,
    jqueryEasing,
    bootstrap4,
    select2,
    toastr,
    jValidate,
) {
    return {
        table: null,
        kecamatan_id: $("#kecamatan_id_selected").val(),
        kelurahan_id: $("#kelurahan_id_selected").val(),
        init: function () {
            App.initFunc();
            App.initEvent();
            App.initForm();
            App.onChangeWilayah();
            $(".dataTables_filter").show();
            $(".loadingpage").hide();
        },
        filter: null,
        initEvent : function(){
            $('*select[data-selectjs="true"]').select2({width: '100%'});

            $("#photo").on("change", function () {
                var files = !!this.files ? this.files : [];

                if (!files.length || !window.FileReader) return;

                if (/^image/.test(files[0].type)) {
                    var reader = new FileReader(); 
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function () {
                        $("#img_preview").attr("src", this.result);
                    }
                }
            });
        },
        initForm : function(){
            if($("#form-create").length > 0){
                $("#form-create").validate({
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
                    },
                    messages: {
                        first_name: {
                            required: function() {
                                toastr.error($('#first_name').attr('placeholder') +' Harus Diisi');
                            },
                        },
                        nik: {
                            required: function() {
                                toastr.error($('#nik').attr('placeholder') +' Harus Diisi');
                            },
                            number: function() {
                                toastr.error($('#nik').attr('placeholder') +' Harus Angka');
                            },
                        },
                        email: {
                            required: function() {
                                toastr.error($('#email').attr('placeholder') +' Harus Diisi');
                            },
                            email: function() {
                                toastr.error($('#email').attr('placeholder') +' Tidak Benar');
                            },
                        },
                        phone: {
                            number: function() {
                                toastr.error($('#phone').attr('placeholder') +' Harus Angka');
                            },
                        },
                        provinsi_id: {
                            required: function() {
                                toastr.error($('#provinsi_id').attr('placeholder') +' Harus Dipilih');
                            },
                        },
                        kabupaten_id: {
                            required: function() {
                                toastr.error($('#kabupaten_id').attr('placeholder') +' Harus Dipilih');
                            },
                        },
                        kecamatan_id: {
                            required: function() {
                                toastr.error($('#kecamatan_id').attr('placeholder') +' Harus Dipilih');
                            },
                        },
                        kelurahan_id: {
                            required: function() {
                                toastr.error($('#kelurahan_id').attr('placeholder') +' Harus Dipilih');
                            },
                        },
                        address: {
                            required: function() {
                                toastr.error($('#address').attr('placeholder') +' Harus Diisi');
                            },
                        },                     
                    },
                    debug:true,    
                    submitHandler : function(form) {
                        form.submit();
                        return false;
                    }
                });
            }

            if($("#form-password").length > 0){
                $("#form-password").validate({
                    rules: {
                        old_password: {
                            required: true,
                            minlength: 8
                        },
                        new_password: {
                            required: true,
                            minlength: 8
                        },
                        confirm_password: {
                            required: true,
                            minlength: 8,
                            equalTo: "#new_password"
                        },
                    },
                    messages: {
                        old_password: {
                            required: $('#old_password').attr('placeholder') +' Harus Diisi',
                            minlength: 'Minimal 8 Digit',
                        },
                        new_password: {
                            required: $('#new_password').attr('placeholder') +' Harus Diisi',
                            minlength: 'Minimal 8 Digit',
                        },
                        confirm_password: {
                            required: $('#confirm_password').attr('placeholder') +' Harus Diisi',
                            minlength: 'Minimal 8 Digit',
                            equalTo: $('#confirm_password').attr('placeholder') +' Tidak Sama dengan ' + $('#new_password').attr('placeholder')
                        },
                    },
                    debug:true,    
                    submitHandler : function(form) {
                        form.submit();
                        return false;
                    }
                });
            }
        },
        onChangeWilayah : function(){
            var provinsi_id = $('.provinsi-id').val();

            $('.kabupaten-id').on('change',function(){
                var kabupaten_id = $(this).val();
                $.ajax({
                    url: App.baseUrl+'wilayah/getKecamatan',
                    type: 'GET',
                    data: {id: kabupaten_id},
                })
                .done(function( response ) {
                    var data = JSON.parse(response);
                    var option_kecamatan = "<option value='' disabled selected>Pilih Kecamatan</option>";
                    var option_kelurahan = "<option value='' disabled selected>Pilih Kelurahan / Desa</option>";
                    $('.kecamatan-id').html(option_kecamatan);
                    $('.kelurahan-id').html(option_kelurahan);

                    if(data.status == true){
                        for (var i = 0; i < data.data.length; i++) {
                            if(App.kecamatan_id == data.data[i].id){
                                option_kecamatan += "<option selected value="+data.data[i].id+"> "+data.data[i].name+"</option>";
                            }else{
                                option_kecamatan += "<option value="+data.data[i].id+"> "+data.data[i].name+"</option>";
                            }
                        }
                    }
                    $('.kecamatan-id').html(option_kecamatan);
                    $('.kecamatan-id').trigger("change");
                })
                .fail(function() {
                    console.log("error");
                });
            });

            $('.kecamatan-id').on('change',function(){
                var kecamatan_id = $(this).val();
                $.ajax({
                    url: App.baseUrl+'wilayah/getKelurahan',
                    type: 'GET',
                    data: {id: kecamatan_id},
                })
                .done(function( response ) {
                    var data = JSON.parse(response);
                    var option_kelurahan = "<option value='' disabled selected>Pilih Kelurahan / Desa</option>";
                    $('.kelurahan-id').html(option_kelurahan);

                    if(data.status == true){
                        for (var i = 0; i < data.data.length; i++) {
                            if(App.kelurahan_id == data.data[i].id){
                                option_kelurahan += "<option selected value="+data.data[i].id+"> "+data.data[i].name+"</option>";
                            }else{
                                option_kelurahan += "<option value="+data.data[i].id+"> "+data.data[i].name+"</option>";
                            }
                        }
                    }
                    $('.kelurahan-id').html(option_kelurahan);
                })
                .fail(function() {
                    console.log("error");
                });
            });

            var kabupaten_id = $('.kabupaten-id').val();

            if(kabupaten_id != undefined && kabupaten_id != null && kabupaten_id != ""){
                $('.kabupaten-id').trigger("change");
            }
        }
    }
});
