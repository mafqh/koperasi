define([
    "jQuery",
    "sbadmin",
    "jqueryEasing",
    "bootstrap4",
    "jValidate",
    "toastr",
    "datatablesBootstrap",
], function(
    $,
    sbadmin,
    jqueryEasing,
    bootstrap4,
    jValidate,
    toastr,
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
            App.initPrivileges();
        },
        initEvent: function() {
            App.checkAllCheckbox();
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
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data di dalam tabel",
                    "infoFiltered": "(cari dari _MAX_ total catatan)",
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
                    "url": App.baseUrl + "role/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "is_deleted" },
                    { "data": "action", "orderable": false },
                ],
            });
        },

        initTableClick: function() {
            $('#table tbody').on('click', '.delete', function() {
                console.log("masuk");
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
                        name: $('#name').attr('placeholder') + ' Harus Diisi'
                    },
                    debug: true,
                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        // Add the `invalid-feedback` class to the error element
                        error.addClass( "invalid-feedback" );
                        if ( element.prop( "type" ) === "checkbox" ) {
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

            if ($("#form-privilege").length > 0) {
                $("#form-privilege").validate({
                    debug: true,
                    submitHandler: function(form) {
                        form.simpan[0].disabled = true;
                        form.submit();
                        return false;
                    }
                });
            }
        },

        checkAllCheckbox: function() {
            _tot_cloud = $(".cb-element-cloud").length
            _tot_cloud_checked = $(".cb-element-cloud:checked").length;
            if (_tot_cloud != _tot_cloud_checked) {
                $("#checkAllCloud").prop('checked', false);
            } else {
                $("#checkAllCloud").prop('checked', true);
            }
        },

        onChangeChild: function() {
            $("#tabcloud tbody").on('change', '.cb-element-cloud-child', function() {
                $parent = $(this).closest("tr").find(".cb-element-cloud");
                $child = $(this).closest("tr").find(".cb-element-cloud-child");
                $childChecked = $(this).closest("tr").find(".cb-element-cloud-child:checked");

                _tot = $child.length
                _tot_checked = $childChecked.length;
                if (_tot != _tot_checked) {
                    $parent.prop('checked', false);
                } else {
                    $parent.prop('checked', true);
                }
                App.checkAllCheckbox();
            });
        },

        onChangeElement: function() {
            $("#tabcloud tbody").on('change', '.cb-element-cloud', function() {
                App.checkAllCheckbox();
                $parent = $(this).closest("tr").find(".cb-element-cloud-child");
                $parent.prop('checked', $(this).prop("checked"));
            });
            App.checkAllCheckbox();
        },

        initPrivileges: function() {
            $("#checkAllCloud").change(function() {
                $("input:checkbox.cb-element-cloud").prop('checked', $(this).prop("checked"));
                $("input:checkbox.cb-element-cloud-child").prop('checked', $(this).prop("checked"));
            });

            $('.cb-element-cloud-child').on('click', function() {
                parent = $(this).closest('.function-parent');
                var checked = $(this).is(':checked') ? true : false;

                if ($(this).val() == 1) {
                    parent.find('.function-2').prop('checked', checked);
                    parent.find('.function-5').prop('checked', checked);
                } else if ($(this).val() == 2) {
                    parent.find('.function-5').prop('checked', checked);
                } else if ($(this).val() == 3) {
                    parent.find('.function-2').prop('checked', checked);
                    parent.find('.function-5').prop('checked', checked);
                } else if ($(this).val() == 4) {
                    parent.find('.function-2').prop('checked', checked);
                    parent.find('.function-5').prop('checked', checked);
                } else {
                    parent.find('.function-2').prop('checked', checked);
                }
            });
        },
    }
});