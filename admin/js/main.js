(function ($) {
    "use strict";
    /*------------------------------

       --------------------------------*/

    jQuery(".main-clear").click(function () {
        alert("Synchronization started. Be patient...it'll take a bit. This page will reload upon completion.");
        $.ajax({
            url:    '../main-clear.php',
            cache:  false,
            success: function(data){
                var site = "index.php";
                //alert('Sync completed successfully');
                document.location.href = site;
                //$(location).attr('href', site);
            },
            error: function(){
                alert('error');
            }
        })
    });
    jQuery(".show").click(function(){
        var v = $(this).val();
        alert(v);
        $.ajax({
            url: '../update.php',
            data: v,
            success: function(data) {
                alert('Product wont appear on Shopify');
            },
            error: function(){
                alert('Shopify product show update error');
            }
        });
    });
    jQuery(".main").click(function(){
        alert("Synchronization started. Be patient...it'll take a bit. This page will reload upon completion.");
        $.ajax({
            url: '../main.php',
            cache: false,
            success: function(data){
                var site = 'index.php';
                //alert('Sync completed successfully');
                //$(location).attr('href', site);
                document.location.href = site;
            },
            error: function(){
                alert('error');
            }
        })
    });

    /*----------------------------
     jQuery MeanMenu
    ------------------------------ */
    // jQuery('nav#dropdown').meanmenu();
    /*----------------------------
     jQuery myTab
    ------------------------------ */
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
    $('#myTab3 a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
    $('#myTab4 a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    $('#single-product-tab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    $('[data-toggle="tooltip"]').tooltip();

   /* $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');

    });*/
   /* // Collapse ibox function
    $('#sidebar ul li').on('click', function () {
        var button = $(this).find('i.fa.indicator-mn');
        button.toggleClass('fa-plus').toggleClass('fa-minus');

    });*/
    /*-----------------------------
            Menu Stick
        ---------------------------------*/
    $(".sicker-menu").sticky({topSpacing: 0});

   /* $('#sidebarCollapse').on('click', function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });*/
    $(document).on('click', '.header-right-menu .dropdown-menu', function (e) {
        e.stopPropagation();
    });


    /*----------------------------
     wow js active
    ------------------------------ */
    new WOW().init();

    /*----------------------------
     owl active
    ------------------------------ */
    $("#owl-demo").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 4,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
    });

    /*----------------------------
     price-slider active
    ------------------------------ */
    $("#slider-range").slider({
        range: true,
        min: 40,
        max: 600,
        values: [60, 570],
        slide: function (event, ui) {
            $("#amount").val("£" + ui.values[0] + " - £" + ui.values[1]);
        }
    });
    $("#amount").val("£" + $("#slider-range").slider("values", 0) +
        " - £" + $("#slider-range").slider("values", 1));

    /*--------------------------
     scrollUp
    ---------------------------- */
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });



 
})(jQuery); 