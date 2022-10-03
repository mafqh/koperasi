define([
    "jQuery",
    "tabler",
    "toastr",
    "jValidate",
    "datatablesBootstrap",
], function(
    $,
    tabler,
    toastr,
    jValidate,
    datatablesBootstrap,
) {
    return {
        table: null,
        init: function() {
            App.initFunc();
            App.initEvent();
            App.initTable();
            App.initTableClick();
            App.initForm();
        },
        initEvent: function() {
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
                    "url": App.baseUrl + "kategori/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "name" },
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
                        name: {
                            required: true,
                        }
                    },
                    messages: {
                        name: {
                            required: function() {
                                toastr.error($('#name').attr('placeholder') + ' Harus Diisi');
                            },
                        }
                    },
                    debug: true,
                    submitHandler: function(form) {
                        form.simpan[0].disabled = true;
                        form.submit();
                        return false;
                    }
                });
            }
        },
    }
});