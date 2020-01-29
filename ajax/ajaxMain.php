<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/28/2020
 * Time: 3:52 AM
 */
session_start();

include('../GetProducts.php');
include('../vendor/phpclassic/php-shopify/lib/ShopifySDK.php');
$config = array(
    'ShopUrl'       =>  'greatamericangold',
    'ApiKey'        =>  'f228e039662e793f769db44bac35bc73',
    'Password'      =>  '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'
);

\PHPShopify\ShopifySDK::config($config);

$GetProducts = new GetProducts();
$goldProducts = json_decode($GetProducts->ByMetalType("Gold"));

echo "<table>";
foreach($goldProducts as $goldProduct){
    echo "<tr><td>".$goldProduct->name."</td><td>".$goldProduct->description."</td><td>".$goldProduct->code."</td></tr>";
}
echo "</table>";


