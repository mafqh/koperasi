define([
    "jQuery",
    "sbadmin",
    "jqueryEasing",
    "bootstrap4",
    "toastr",
    'highcharts',
    "select2",
], function (
    $,
    sbadmin,
    jqueryEasing,
    bootstrap4,
    toastr,
    Highcharts,
    select2,
) {
    return {
        table:null,
        init: function () {
        	App.initFunc();
            App.initData();
            $(".loading-page").hide();
		},
        initData: function (filter = null) {
        },
    
	}
});
