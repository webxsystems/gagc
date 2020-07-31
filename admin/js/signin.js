// JavaScript Document
/* 
 Orginal Page: http://thecodeplayer.com/walkthrough/jquery-multi-step-form-with-progress-bar

 */
//jQuery time

jQuery(document).ready(function() {

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

        var serializedValues = jQuery("#loginForm").serialize();
        // alert('login : '+serializedValues);
        var form_data = {
            action: 'ajax_data',
            type: 'post',
            data: serializedValues
        };

        jQuery.post('signinDB.php', form_data, function (response) {
            console.log(response);
            if(response == 'success') {
                document.location = "index.php";
            }else{
                jQuery('.serror').html('<span style="color:red;">Invalid Login</span>');
                jQuery('.serror').show();
            }
        });


        return false;
    });

    // $(".logout").click(function(){
    //
    // })

});
