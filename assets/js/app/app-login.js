define([
    "jQuery",
    "sbadmin",
    "jqueryEasing",
    "bootstrap4",
    "jValidate",
    ], function (
    $,
    sbadmin,
    jqueryEasing,
    bootstrap4,
    jValidate,
    ) {
    return {  
        init: function () { 
            App.initFunc();
            App.initLogin(); 
        },
         
        initLogin : function(){  
            $("#form-login").validate({ 
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: "*Harus Diisi"
                    },
                    password: {
                        required: "*Harus Diisi"
                    }
                }, 
                debug:true,
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
                submitHandler : function(form) { 
                    form.submit();
                }
            });
        }
    }
});