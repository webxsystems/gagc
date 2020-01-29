// JavaScript Document
/* 
 Orginal Page: http://thecodeplayer.com/walkthrough/jquery-multi-step-form-with-progress-bar

 */
//jQuery time

jQuery(document).ready(function() {

    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches
    var email = jQuery('#email').val();
    var pass = jQuery('#pass').val();
    var fname = jQuery('#fname').val();
    var lname = jQuery('#lname').val();
//    var error = jQuery('.error1').val() ;



//    jQuery("#email").onfocus(function(){
//        jQuuery('.error1').html('<span></span>');
 //       jQuuery('.error1').show();
 //   })


    jQuery(".next").click(function(){

       //alert(document.getElementById("f1").getAttribute("placeholder"));


//       if(jQuery.trim(document.getElementById("email").value).length == 0){
       if(jQuery.trim(document.getElementById("f1").value).length == 0){
            jQuery('.error1').html('<span style="color:red;">Please Enter a ' + document.getElementById("f1").getAttribute("placeholder") + '</span>');
            jQuery('.error1').show();
            return false;
       }else{
           jQuery('.error1').html('<span>&nbsp;</span>');
           jQuery('.error1').hide();
       }

       if(jQuery.trim(document.getElementById("f2").value).length == 0){
            jQuery('.error1').html('<span style="color:red;">Please Enter a ' + document.getElementById("f2").getAttribute("placeholder") + '</span>');;
            jQuery('.error1').show();
            return false;
       }else{
           jQuery('.error1').html('<span>&nbsp;</span>');
           jQuery('.error1').hide();
       }
/*
       if(jQuery.trim(document.getElementById("fname").value).length == 0){
            jQuery('.error1').html('<span style="color:red;">Please Enter a First Name !</span>');
            jQuery('.error1').show();
            return false;
       }else{
           jQuery('.error1').html('<span>&nbsp;</span>');
           jQuery('.error1').hide();
       }

       if(jQuery.trim(document.getElementById("lname").value).length == 0){
            jQuery('.error1').html('<span style="color:red;">Please Enter a Last Name !</span>');
            jQuery('.error1').show();
            return false;
       }else{
           jQuery('.error1').html('<span>&nbsp;</span>');
           jQuery('.error1').hide();
       }*/


        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();



        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'



        });
    });

    jQuery(".next2").click(function(){

       /* if(jQuery.trim(document.getElementById("address").value).length == 0){
            jQuery('.error2').html('<span style="color:red;">Please Enter an Address !</span>');
            jQuery('.error2').show();
            return false;
        }else{
            jQuery('.error2').html('<span>&nbsp;</span>');
            jQuery('.error2').hide();
        }


        if(jQuery.trim(document.getElementById("zipcode").value).length == 0){
            jQuery('.error2').html('<span style="color:red;">Please Enter a Zipcode !</span>');
            jQuery('.error2').show();
            return false;
        }else{
            jQuery('.error2').html('<span>&nbsp;</span>');
            jQuery('.error2').hide();
        }*/

        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();



        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'



        });

    });

    $(".previous").click(function(){
        if(animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1-now) * 50)+"%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".submit").click(function(){
       /* if(jQuery.trim(document.getElementById("cardnumber").value).length == 0){
            jQuery('.error3').html('<span style="color:red;">Please Enter a Card Number !</span>');
            jQuery('.error3').show();
            return false;
        }else{
            jQuery('.error3').html('<span>&nbsp;</span>');
            jQuery('.error3').hide();
        }

        if(jQuery.trim(document.getElementById("expmo").value).length == 0){
            jQuery('.error3').html('<span style="color:red;">Please Enter a Expiry Month !</span>');
            jQuery('.error3').show();
            return false;
        }else{
            jQuery('.error3').html('<span>&nbsp;</span>');
            jQuery('.error3').hide();
        }

        if(jQuery.trim(document.getElementById("expyr").value).length == 0){
            jQuery('.error3').html('<span style="color:red;">Please Enter a Expiry Year !</span>');
            jQuery('.error3').show();
            return false;
        }else{
            jQuery('.error3').html('<span>&nbsp;</span>');
            jQuery('.error3').hide();
        }

        if(jQuery.trim(document.getElementById("cvc").value).length == 0){
            jQuery('.error3').html('<span style="color:red;">Please Enter a CVC Number !</span>');
            jQuery('.error3').show();
            return false;
        }else{
            jQuery('.error3').html('<span>&nbsp;</span>');
            jQuery('.error3').hide();
        }

        if(jQuery.trim(document.getElementById("cczip").value).length == 0){
            jQuery('.error3').html('<span style="color:red;">Please Enter a CC Zip !</span>');
            jQuery('.error3').show();
            return false;
        }else{
            jQuery('.error3').html('<span>&nbsp;</span>');
            jQuery('.error3').hide();
        }*/
        var serializedValues = jQuery("#msform").serialize();

        var form_data = {
            action: 'ajax_data',
            type: 'post',
            data: serializedValues
        };

        jQuery.post('signupDB.php', form_data, function (response) {
            if(response == 'success') {
                document.location = "admin/profilePrivate.php";
            }else{
                jQuery('.serror').html('<span style="color:red;">An error has occurred</span>');
                jQuery('.serror').show();
            }
        });

        return false;

    });

    $(".signin").click(function(){

        if(jQuery.trim(document.getElementById("semail").value).length == 0){
            jQuery('.serror').html('<span style="color:red;">Please Enter a Username !</span>');
            jQuery('.serror').show();
            return false;
        }else{
            jQuery('.serror').html('<span>&nbsp;</span>');
            jQuery('.serror').hide();
        }

        if(jQuery.trim(document.getElementById("spass").value).length == 0){
            jQuery('.serror').html('<span style="color:red;">Please Enter your Password !</span>');
            jQuery('.serror').show();
            return false;
        }else{
            jQuery('.serror').html('<span>&nbsp;</span>');
            jQuery('.serror').hide();
        }

        var serializedValues = jQuery("#siform").serialize();

        var form_data = {
            action: 'ajax_data',
            type: 'post',
            data: serializedValues
        };

        jQuery.post('signinDB.php', form_data, function (response) {
            if(response == 'success') {
                document.location = "admin/admin.php";
            }else{
                jQuery('.serror').html('<span style="color:red;">Invalid Login</span>');
                jQuery('.serror').show();
            }
        });


        return false;
    });

    $("#zipcheck").click(function(){

        if(jQuery.trim(document.getElementById("zipc").value).length == 0){
            jQuery('#zerror').html('<span style="color:red;">Please Enter a Valid Zip !</span>');
            jQuery('#zerror').show();
            return false;
        }else{
            jQuery('#zerror').html('<span>&nbsp;</span>');
            jQuery('#zerror').hide();
        }

        var serializedValues = jQuery("#zipform").serialize();

        var form_data = {
            action: 'ajax_data',
            type: 'post',
            data: serializedValues
        };

        jQuery.post('zipcheck.php', form_data, function (response) {
            if(response == 'success') {
          //      alert(response);
                document.location = "signup1.php";
            }else{
                jQuery('#zerror').html('<span style="color:#23527c;">You Are Outside Of Our Coverage Range</span>');
                jQuery('#zerror').show();
            }
        });


        return false;
    })

});

function formData(){
    var serializedValues = jQuery("#msform").serialize();
    var formData = {
        action: 'ajax_data',
        type: 'post',
        data: serializedValues
    };
    jQuery.post('signupDB.php', formData, function (response) {
        alert(response);
    } );
    return serializedValues;
}