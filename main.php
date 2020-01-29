<?php
session_start();
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/28/2020
 * Time: 3:52 AM
 */

//include('GetProducts.php');
//
//$GetProducts = new GetProducts();
//$goldProducts = json_decode($GetProducts->ByMetalType("Gold"));
//print_r($goldProducts);

?>
<html>
<head>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css">

<script type="text/javascript">
    $(document).ready(function ()
    {
        $('#getProducts').click(function() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "ajax/ajaxMain.php",
                success: function (data) {
                    alert("success");
                    console.log(data);
                },
                error: function (data) {
                    if(data.statusText == "OK"){
                        alert(data.responseText);
                        console.log(data.responseText);
                    }else{
                        alert("error");
                        console.log(data);
                    }
                }
            });
        });
    });

</script>
</head>
<body>
    <div>
        <p style="padding:100px;"><button class="btn-info" id="getProducts" value="get" style="padding:10px 20px;">Get Products</button> </p>
    </div>
    <?php
    var_dump($_SESSION);
    ?>


</body>
</html>