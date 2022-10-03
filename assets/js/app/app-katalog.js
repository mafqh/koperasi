define([
    "jQuery",
    "tabler",
    "toastr",
    "jValidate",
    "datatablesBootstrap",
    "select2",
    "dropzone"
], function(
    $,
    tabler,
    toastr,
    jValidate,
    datatablesBootstrap,
    select2,
    dropzone
) {
    return {
        file: 0,
        table: null,
        init: function() {
            App.initFunc();
            App.initEvent();
            App.initSelect2();
            App.initTable();
            App.initTableClick();
            App.initForm();
            App.initDropzone();
        },
        initEvent: function() {
        },
        initSelect2: function() {
            $("#kategori_id").select2({
                width: "100%",
                placeholder: "Pilih Kategori"
            });
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
                    "url": App.baseUrl + "katalog/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "kategori_name" },
                    { "data": "judul" },
                    { "data": "is_deleted" },
                    { "data": "action", "orderable": false },
                ],
            });
        },
        initTableClick: function() {
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
        initForm: function() {
            if ($("#form").length > 0) {
                $("#form").validate({
                    rules: {
                        kategori_id: {
                            required: true,
                        },
                        judul: {
                            required: true,
                        },
                    },
                    messages: {
                        kategori_id: {
                            required: function() {
                                toastr.error('Kategori Harus Dipilih');
                            },
                        },
                        judul: {
                            required: function() {
                                toastr.error($('#judul').attr('placeholder') + ' Harus Diisi');
                            },
                        },
                    },
                    debug: true,
                    submitHandler: function(form) {
                        if(App.file == 0){
                            form.submit();
                        }else{
                            dzClosure.processQueue()
                        }
                        return false;
                    }
                });
            }
        },
        initDropzone: function() {
            var url = App.baseUrl + 'katalog/create';
            if($("#id").length > 0){
                url = App.baseUrl + 'katalog/edit/' + $("#id").val(); 
            }

            $("#dropzone_katalog").dropzone({ 
                url: url,
                autoProcessQueue: false,
                uploadMultiple: true,
                addRemoveLinks: true,
                parallelUploads: 5,
                maxFilesize: 10,
                paramName: 'katalog_image',
                acceptedFiles: 'image/*',
                init: function(response) {
                    dzClosure = this;

                    //proses menampilkan file yang ada (untuk edit)
                    if($('#image_existing').length > 0){
                        var existing_files = $.parseJSON($('#image_existing').val());
                        $.each(existing_files, function(index, el) {
                            dzClosure.emit("addedfile", el);
                            dzClosure.emit("thumbnail", el, App.baseUrl + 'uploaded/katalog/' + el.name);
                            dzClosure.emit("success", el);
                            dzClosure.emit("complete", el);
                            dzClosure.files.push(el);
                        });
                    }
                    $('.dz-image img').attr('width', 125);
                    $('.dz-image img').attr('height', 125);
                    //end proses

                    //proses ketika sebelum dikirim ke controller
                    this.on("sendingmultiple", function(data, xhr, formData) {
                        formData.append('kategori_id', $('#kategori_id').val());
                        formData.append('judul', $('#judul').val());
                        formData.append('isi', $('#isi').val());
                    })

                    this.on('success', function(file){
                        window.location.href = App.baseUrl + "katalog";
                    })
                    
                    this.on('removedfile', function(file){
                        if(file.status == undefined){
                            App.delete_file(file.name);
                        }else{
                            App.file--;
                        }
                    })

                    this.on("addedfile", function(file) {
                        App.file++;
                    })
                } 
            });
        },
        delete_file : function(name){
            const id = $('#id').val();
            $.ajax({
                url: App.baseUrl + 'katalog/delete_file',
                type: 'POST',
                dataType: 'json',
                data: {
                    name: name,
                },
                beforeSend: function(){
                    $('.loading').show();
                }
            })
            .done(function(response) {
                console.log("success");
                App.alert('Berhasil menghapus !');
            })
            .fail(function(response) {
                console.log("error");
            })
            .always(function(response) {
                console.log("complete");
                $('.loading').hide();
            });
            
        },
    }
});