<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/29/2020
 * Time: 9:56 PM
 */

use PHPShopify\ShopifySDK;

require __DIR__ . '\vendor\autoload.php';

$product = array(
            "product"   =>
                array(
                        "title" => "Burton Custom Freestyle 151",
                        "body_html" => "<strong>Good snowboard!</strong>",
                        "vendor" => "Burton",
                        "product_type" => "Snowboard"
                )
);

//print_r(json_encode($product));

$config = array(
    'ShopUrl'       =>  'greatamericangold.myshopify.com',
    'ApiKey'        =>  '1b8627578b2b9d0896f7392803221e10',
    'Password'      =>  '62a23c57e44dfcafe8340d432ea37176'
);

$shopify = new ShopifySDK($config);

$p = $shopify->Product->get();
echo "<pre>";
print_r($p);
echo "</pre>";

 //Create a new product
 $productInfo = array(
    "title" => "Burton Custom Freestlye 151",
    "body_html" => "<strong>Good snowboard!<\/strong>",
    "vendor" => "Burton",
    "product_type" => "Snowboard",
 );
 //$products = $shopify->Product->post($productInfo);

 //print_r($products);
