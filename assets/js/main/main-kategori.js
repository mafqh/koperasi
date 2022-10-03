require(["../common" ], function (common) {  
    require(["main-function","../app/app-kategori"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});