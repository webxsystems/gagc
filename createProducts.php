<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/29/2020
 * Time: 7:20 PM
 */

/*
Create a new product with the default product variant

POST /admin/api/2020-01/products.json

$product = array(
            "product"   =>
                array(
                        "title" => "1/2 GRAM GOLD BAR IGR",
                        "body_html" => "GOLD BARS ASSORTED WEIGHTS",
                        "vendor" => "PRIVATE MINT",
                        "product_type" => "Bullion Bars"
                )
);

| $products = $shopify->Product->post($productInfo);

{
    "product": {
    "title": "",
    "body_html": "GOLD BARS ASSORTED WEIGHTS",
    "vendor": "PRIVATE MINT",
    "product_type": "Bullion Bars",
    "tags": [
        "Barnes & Noble",
        "John's Fav",
        "\"Big Air\""
    ]
  }
}


            [isIRAConnectEligible] => N
            [origin] => PRIVATE MINT
            [name] => 1/2 GRAM GOLD BAR IGR
            [metalType] => Gold
            [code] => .5GRGBIGR
            [description] => GOLD BARS ASSORTED WEIGHTS
            [isActiveBuy] => Y
            [weight] => .5 g
            [meltFactor] => 0.01608
            [isActiveSell] => N
            [isSpecial] => N
            [category] => Bullion Bars
            [availability] => Not Available
            [isIRAEligible] => N
            [fineness] => .9999 FINE GOLD
            [isFractional] => N
            [isRSPConnectEligible] => N
        )
*/

class createProducts
{

private $api;
private $returnJSON;
private $devServerURL;
private $path;
private $method;
private $url;
private $c;
private $fullpath;


function __construct()
{
    $this->api = "4103-906cd5f5ebddd4dab583e9a5ec0e414d/";
    $this->devServerURL = "https://stage-connect.fiztrade.com/";
    $this->path = "FizServices/";
}

public function createProduct()
{
    $productinfo   =  array(
                "title" => "1/2 GRAM GOLD BAR IGR",
                "body_html" => "GOLD BARS ASSORTED WEIGHTS",
                "vendor" => "PRIVATE MINT"
    );

    $products =
}