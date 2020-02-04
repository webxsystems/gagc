<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/29/2020
 * Time: 9:56 PM
 */

require __DIR__ . '/vendor/autoload.php';

use PHPShopify\ShopifySDK;
//
//
//$product = array(
//            "product"   =>
//                array(
//                        "title" => "Burton Custom Freestyle 151",
//                        "body_html" => "<strong>Good snowboard!</strong>",
//                        "vendor" => "Burton",
//                        "product_type" => "Snowboard"
//                )
//);

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
            "title" => $shopify->
            "body_html" =>
            "vendor" =>
            "product_type" =>
            "created_at" =>
            "handle" =>
            "updated_at" =>
            "published_at" =>
            "template_suffix" =>
            "published_scope" =>
            "tags" =>
            "admin_graphql_api_id" =>
            "variants" => Array
                            (
                            "0" => Array
                                    (
                                     "id" =>
                                     "product_id" =>
                                     "title" =>
                                     "price" =>
                                     "sku" =>
                                     "position" =>
                                     "inventory_policy" =>
                                     "compare_at_price" =>
                                     "fulfillment_service" =>
                                     "inventory_management" =>
                                     "option1" =>
                                     "option2" =>
                                     "option3" =>
                                     "created_at" =>
                                     "updated_at" =>
                                     "taxable" =>
                                     "barcode" =>
                                     "grams" =>
                                     "image_id" =>
                                     "weight" =>
                                     "weight_unit" =>
                                     "inventory_item_id" =>
                                     "inventory_quantity" =>
                                     "old_inventory_quantity" =>
                                     "requires_shipping" =>
                                     "admin_graphql_api_id" =>
                                     )

            "options" => Array
            (
                            "0" => Array
                             (
                                    "id" =>
                                    "product_id" =>
                                    "name" =>
                                    "position" =>
                                    "values" => Array
                                    (
                                         "0" =>
                                    )
                             )
             )

            "images" => Array
            (
                    "0" => Array
                    (
                            "id" =>
                            "product_id" =>
                            "position" =>
                            "created_at" =>
                            "updated_at" =>
                            "alt" =>
                            "width" =>
                            "height" =>
                            "src" =>
                            "variant_ids" => Array
                            (
                            )
                            "admin_graphql_api_id" =>
                     )

            )

            "image" => Array
                (
                    "id" =>
                    "product_id" =>
                    "position" =>
                    "created_at" =>
                    "updated_at" =>
                    "alt" =>
                    "width" =>
                    "height" =>
                    "src" =>
                    "variant_ids" => Array
                        (
                        )
                        "admin_graphql_api_id" =>
                )

        )
  );
 
 //$products = $shopify->Product->post($productInfo);

 //print_r($products);
