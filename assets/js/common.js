var App;
if (!window.console) {
    var console = {
        log: function() {},
        warn: function() {},
        error: function() {},
        time: function() {},
        timeEnd: function() {}
    }
}
var log = function() {};

require.config({
    paths: {
        "jQuery": "../../plugins/jquery/jquery.min",
        "jqueryEasing": "../../plugins/jquery-easing/jquery.easing.min",
        "sbadmin": "../../plugins/sbadmin/sb-admin-2.min",
        "jValidate": "../../plugins/jquery-validate/jquery.validate.min",
        "datatables": "../../plugins/datatables/DataTables-1.12.1/js/jquery.dataTables.min",
        "bootstrap4": "../../plugins/bootstrap4/js/bootstrap.bundle.min",
        "datatablesBootstrap": "../../plugins/datatables/DataTables-1.12.1/js/dataTables.bootstrap5.min",
        "datatablesResponsive": "../../plugins/datatables/Responsive-2.3.0/js/dataTables.responsive.min",
        "select2": "../../plugins/select2/js/select2.min",
        "flatPicker": "../../plugins/flatpicker/flatpickr.min",
        "flatPickerLocale": "../../plugins/flatpicker/l10n/id",
        "bootstrapDatePicker": "../../plugins/bootstrap-datepicker/bootstrap-datepicker.min",
        "toastr": "../../plugins/toastr/toastr.min",
        "moment": "../../plugins/moment/moment.min",
        "tinymce": "../../plugins/tinymce/tinymce.min",
        "tinymceLocale": "../../plugins/tinymce/langs/id",
        "dropzone": "../../plugins/dropzone/dropzone.min",
        "waypoint": "../../plugins/counterUp/jquery.waypoints.min",
        "jCounterUp": "../../plugins/counterUp/jquery.counterup.min",
        "leaflet": "../../plugins/map/leaflet/leaflet",
        "catiline": "../../plugins/map/catiline/dist/catiline.min",
        "shp": "../../plugins/map/shp/dist/shp.min",
        "fileGdb": "../../plugins/map/filegdb/dist/fgdb.min",
        "markerCluster": "../../plugins/map/markercluster/dist/leaflet.markercluster",
        "zoomSlider": "../../plugins/map/zoomslider/L.Control.Zoomslider",
        "spin": "../../plugins/map/spin/dist/spin.min",
        "leafletSpin": "../../plugins/map/spin/leaflet.spin.min",
        "colorbrewer": "../../plugins/map/colorbrewer",
        'highcharts': '../../plugins/highcharts',
        "PDFObject": "../../plugins/pdfobject/pdfobject.min"
    },
    waitSeconds: 0,
    urlArgs: "bust=" + (new Date()).getTime(),
    shim: {
        "jQuery": {
            exports: "jQuery",
            init: function() {
                console.log('JQuery inited..');
            }
        },
        "jqueryEasing": {
            deps: ["jQuery"],
            exports: "jqueryEasing",
            init: function() {
                console.log('jqueryEasing inited..');
            }
        },
        "sbadmin": {
            deps: ["jQuery"],
            exports: "sbadmin",
            init: function() {
                console.log('sbadmin inited..');
            }
        },
        "jValidate": {
            deps: ["jQuery"],
            exports: "jValidate",
            init: function() {
                console.log('jValidate inited..');
            }
        },
        "datatables": {
            deps: ["jQuery"],
            exports: "datatables",
            init: function() {
                console.log('datatables inited..');
            }
        },
        "datatablesResponsive": {
            deps: ["jQuery", "datatables"],
            exports: "datatablesResponsive",
            init: function() {
                console.log('datatablesResponsive inited..');
            }
        },
        "datatablesBootstrap": {
            deps: ["jQuery", "datatablesResponsive"],
            exports: "datatablesBootstrap4",
            init: function() {
                console.log('datatablesBootstrap4 inited..');
            }
        },
        "select2": {
            deps: ["jQuery"],
            exports: "select2",
            init: function() {
                console.log('select2 inited..');
            }
        },
        "flatPicker": {
            deps: ["jQuery"],
            exports: "flatPicker",
            init: function() {
                console.log('flatPicker inited..');
            }
        },
        "flatPickerLocale": {
            deps: ["jQuery", "flatPicker"],
            exports: "flatPicker",
            init: function() {
                console.log('flatPickerLocale inited..');
            }
        },
        "bootstrapDatePicker": {
            deps: ["jQuery"],
            exports: "bootstrapDatePicker",
            init: function() {
                console.log('bootstrapDatePicker inited..');
            }
        },
        "toastr": {
            deps: ["jQuery"],
            exports: "toastr",
            init: function() {
                console.log('toastr inited..');
            }
        },
        "moment": {
            deps: ["jQuery"],
            exports: "moment",
            init: function() {
                console.log('moment inited..');
            }
        },
        "tinymce": {
            deps: ["jQuery"],
            exports: "tinymce",
            init: function() {
                console.log('tinymce inited..');
            }
        },
        "tinymceLocale": {
            deps: ["jQuery", "tinymce"],
            exports: "tinymceLocale",
            init: function() {
                console.log('tinymceLocale inited..');
            }
        },
        "dropzone": {
            deps: ["jQuery"],
            exports: "dropzone",
            init: function() {
                console.log('dropzone inited..');
            }
        },
        "waypoint": {
            deps: ["jQuery"],
            exports: "waypoint",
            init: function() {
                console.log('waypoint inited..');
            }
        },
        "jCounterUp": {
            deps: ["jQuery", "waypoint"],
            exports: "jCounterUp",
            init: function() {
                console.log('jCounterUp inited..');
            }
        },
        "leaflet": {
            deps: ["jQuery"],
            exports: "leaflet",
            init: function() {
                console.log('leaflet inited..');
            }
        },
        "catiline": {
            deps: ["jQuery", "leaflet"],
            exports: "catiline",
            init: function() {
                console.log('leaflet catiline inited..');
            }
        },
        "shp": {
            deps: ["jQuery", "leaflet"],
            exports: "shp",
            init: function() {
                console.log('leaflet shp inited..');
            }
        },
        "fileGdb": {
            deps: ["jQuery", "leaflet"],
            exports: "fileGdb",
            init: function() {
                console.log('leaflet fileGdb inited..');
            }
        },
        "markerCluster": {
            deps: ["jQuery", "leaflet"],
            exports: "markerCluster",
            init: function() {
                console.log('leaflet markerCluster inited..');
            }
        },
        "zoomSlider": {
            deps: ["jQuery", "leaflet"],
            exports: "zoomSlider",
            init: function() {
                console.log('leaflet zoomSlider inited..');
            }
        },
        "spin": {
            deps: ["jQuery"],
            exports: "spin",
            init: function() {
                console.log('spin inited..');
            }
        },
        "leafletSpin": {
            deps: ["jQuery", "leaflet", "spin"],
            exports: "leafletSpin",
            init: function() {
                console.log('leaflet leafletSpin inited..');
            }
        },
        "colorbrewer": {
            deps: ["jQuery"],
            exports: "colorbrewer",
            init: function() {
                console.log('colorbrewer inited..');
            }
        },
        "PDFObject": {
            deps: ["jQuery"],
            exports: "PDFObject",
            init: function() {
                console.log('PDFObject inited..');
            }
        },
        "bootstrap4": {
            deps: ["jQuery"],
            exports: "bootstrap4",
            init: function() {
                console.log('bootstrap4 inited..');
            }
        },
    },
    map: {
        '*': {
            'jquery': 'jQuery',
            'datatables.net': 'datatables',
        }
    },
    packages: [{
        name: 'highcharts',
        main: 'highcharts'
    }],

});