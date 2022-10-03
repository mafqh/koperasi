define([
    "jQuery",
    "toastr",
    "colorbrewer",
], function(
    $,
    toastr,
    colorbrewer,
) {
    return {
        clickEvent: "click",
        loading: $("#loading"),
        baseUrl: document.getElementById("base_url").value,
        initFunc: function() {
            App.initPage();
            // App.initDisableRightClick();
            App.initLoadingPage();
            App.initToast();
            App.validInput();
        },

        initPage: function() {
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            $(window).scroll(function(event) {
                var scroll = $(window).scrollTop();
                if (scroll > 20) {
                    setTimeout(function() {
                        $('#toTop').removeClass("invisible");
                    }, 1000);
                    $('#toTop').fadeIn(2000);
                } else {
                    $('#toTop').fadeOut(2000);
                    setTimeout(function() {
                        $('#toTop').addClass('invisible')
                    }, 1000);
                }
            });

            $(".modal-dialog-scrollable .modal-body").css({
                "overflow-y": "scroll",
                "-webkit-overflow-scrolling": "touch"
            });

            $('#toTop').on('click', function() {
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            })
        },
        initDisableRightClick: function() {
            $(document).bind("contextmenu", function(e) {
                e.preventDefault();
            });
            $(document).onkeypress = function(event) {
                event = (event || window.event);
                if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                    return false;
                } else if (event.ctrlKey && event.shiftKey && event.keyCode == 74) {
                    return false;
                } else if (event.keyCode == 83 && (navigator.platform.match("Mac") ? event.metaKey : event.ctrlKey)) {
                    return false;
                } else if (event.ctrlKey && event.keyCode == 85) {
                    return false;
                } else if (event.keyCode == 123) {
                    return false;
                }
            }
            $(document).onmousedown = function(event) {
                event = (event || window.event);
                if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                    return false;
                } else if (event.ctrlKey && event.shiftKey && event.keyCode == 74) {
                    return false;
                } else if (event.keyCode == 83 && (navigator.platform.match("Mac") ? event.metaKey : event.ctrlKey)) {
                    return false;
                } else if (event.ctrlKey && event.keyCode == 85) {
                    return false;
                } else if (event.keyCode == 123) {
                    return false;
                }
            }
            $(document).onkeydown = function(event) {
                event = (event || window.event);
                if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                    return false;
                } else if (event.ctrlKey && event.shiftKey && event.keyCode == 74) {
                    return false;
                } else if (event.keyCode == 83 && (navigator.platform.match("Mac") ? event.metaKey : event.ctrlKey)) {
                    return false;
                } else if (event.ctrlKey && event.keyCode == 85) {
                    return false;
                } else if (event.keyCode == 123) {
                    return false;
                }
            }
        },
        initLoadingPage: function() {
            setTimeout(function() {
                $('.loading-page').hide();
            }, 1000);
        },
        initToast: function() {
            toastr.options.preventDuplicates = true;
            toastr.options.timeOut = 1000;
            toastr.options.positionClass = 'toast-top-right';

            if ($('#display_alert_message').val() != undefined) {
                toastr.options.timeOut = 3000;
                toastr.success($('#display_alert_message').val());
            }
            if ($('#display_alert_message_error').val() != undefined) {
                toastr.options.timeOut = 3000;
                toastr.error($('#display_alert_message_error').val());
            }
            if ($('#display_alert_validation_errors').val() != undefined) {
                toastr.options.timeOut = 3000;
                toastr.error($('#display_alert_validation_errors').val());
            }
            if ($('#display_alert_message_get_true').val() != undefined) {
                toastr.options.timeOut = 3000;
                toastr.success($('#display_alert_message_get_true').val());
            }
            if ($('#display_alert_message_get_false').val() != undefined) {
                toastr.options.timeOut = 3000;
                toastr.error($('#display_alert_message_get_false').val());
            }
        },
        validInput: function() {
            $(".text-only").keyup(function(e) {
                var regex = /^[a-zA-Z X]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^a-zA-Z X]+/, '');
                }
            });
            $(".number-only").keyup(function(e) {
                var regex = /^[0-9 X]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^0-9 X]+/, '');
                }
            });
            $(".text-nospace").keyup(function(e) {
                var regex = /^[a-zA-Z]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^a-zA-Z]+/, '');
                }
            });
            $(".number-nospace").keyup(function(e) {
                var regex = /^[0-9]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^0-9]+/, '');
                }
            });
            $(".textnumber").keyup(function(e) {
                var regex = /^[a-zA-Z0-9 X]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^a-zA-Z0-9 X]+/, '');
                }
            });
            $(".textnumber-nospace").keyup(function(e) {
                var regex = /^[a-zA-Z0-9]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^a-zA-Z0-9]+/, '');
                }
            });
            $(".textsymbol").keyup(function(e) {
                var regex = /^[a-zA-Z(&).,:\-/ X]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^a-zA-Z(&).,:\-/ X]+/, '');
                }
            });
            $(".textnumbersymbol").keyup(function(e) {
                var regex = /^[a-zA-Z0-9(&).,:\-/ X]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^a-zA-Z0-9(&).,:\-/ X]+/, '');
                }
            });
            $(".numbersymbol").keyup(function(e) {
                var regex = /^[0-9(&).,:\-/ X]+$/;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/[^0-9(&).,:\-/ X]+/, '');
                }
            });
            $(".procentage").keyup(function(e) {
                var regex = /(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$/i;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/(^100([.]0{1,2})?)$|(^\d{1,2}([.]\d{1,2})?)$/i, '');
                }
            });
            $(".basic-url").keyup(function(e) {
                var regex = /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
                if (regex.test(this.value) !== true) {
                    this.value = this.value.replace(/^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i, '');
                }
            });

            $(".currency").on("keyup", function() {
                value = $(this).val().replace(/,/g, '');
                if (!$.isNumeric(value) || value == NaN) {
                    $(this).val('0').trigger('change');
                    value = 0;
                }
                $(this).val(parseFloat(value, 10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
            });
        },
        alert: function(msg, callbackOk) {
            $("#alert_modal .alert-title").text("INFORMASI");

            $(".alert-msg").text(msg);
            $(".alert-cancel").hide();
            $(".alert-ok").show();

            $('#alert_modal').modal('show');

            $("#alert_modal .alert-ok").bind(App.clickEvent, function(e) {
                if (callbackOk != undefined && callbackOk != null && callbackOk != false) {
                    callbackOk();
                }
                setTimeout(function() {
                    $("#alert_modal").modal("hide");
                }, 200);

                e.preventDefault();
                $(this).unbind();
                $("#alert_modal .alert-cancel").unbind();
            });
        },
        confirm: function(msg, callbackOk, callbackCancel) {
            $("#alert_modal .alert-title").text("KONFIRMASI");

            $(".alert-msg").text(msg);
            $(".alert-cancel").show();
            $(".alert-ok").show();

            $('#alert_modal').modal('show');

            $("#alert_modal .alert-ok").bind(App.clickEvent, function(e) {
                if (callbackOk != undefined && callbackOk != null && callbackOk != false) {
                    callbackOk();
                }
                setTimeout(function() {
                    $("#alert_modal").modal("hide");
                }, 200);

                e.preventDefault();
                $(this).unbind();
                $("#alert_modal .alert-cancel").unbind();
            });

            $("#alert_modal .alert-cancel").bind(App.clickEvent, function(e) {
                if (callbackCancel != undefined && callbackCancel != null && callbackCancel != false) {
                    callbackCancel();
                }
                setTimeout(function() {
                    $("#alert_modal").modal("hide");
                }, 200);

                e.preventDefault();
                $(this).unbind();
                $("#alert_modal .alert-ok").unbind();
            });
        },
        approval: function(msg, callbackOk, callbackCancel) {
            $("#alert_approval .modal-title").text("VERIFIKASI");

            $(".alert-msg").text(msg);
            $(".alert-cancel").show();
            $(".alert-reject").show();
            $(".alert-approve").show();

            $('#alert_approval').modal('show');
            $("#alert_approval .alert-cancel").bind(App.clickEvent, function(e) {
                setTimeout(function() {
                    $("#alert_approval").modal("hide");
                }, 200);

                e.preventDefault();
                $(this).unbind();
                $("#alert_approval .alert-approve").unbind();
            });
            $("#alert_approval .alert-approve").bind(App.clickEvent, function(e) {
                if (callbackOk != undefined && callbackOk != null && callbackOk != false) {
                    callbackOk();
                }
                setTimeout(function() {
                    $("#alert_approval").modal("hide");
                }, 200);

                e.preventDefault();
                $(this).unbind();
                $("#alert_approval .alert-cancel").unbind();
            });

            $("#alert_approval .alert-reject").bind(App.clickEvent, function(e) {
                if (callbackCancel != undefined && callbackCancel != null && callbackCancel != false) {
                    callbackCancel();
                }
                setTimeout(function() {
                    $("#alert_approval").modal("hide");
                }, 200);

                e.preventDefault();
                $(this).unbind();
                $("#alert_approval .alert-ok").unbind();
            });
        },
    }
});