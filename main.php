<?php
/**
 * Created by PhpStorm.
 * User: webxsys
 * Date: 2/5/20
 * Time: 1:12 AM
 */

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/fiztradeGetProducts.php';
require __DIR__ . '/fiztradeGetPrices.php';
require __DIR__ . '/fiztradeGetImages.php';
require __DIR__ . '/shopifyProduct.php';
require __DIR__ . '/shopifyImage.php';

use PHPShopify\ShopifySDK;

define('GOLD', 'Gold');
define('SILVER', 'silver');
define('PLATINUM', 'platinum');
define('SEP','/');


$variants = array();
$title  = "";
$body_html = "";
$vendor = "";
$product_type = "";
$tags = "";
$vTitle = "";
$vPrice = "";
$weight = "";
$price = "";
$optionName = "";
$optionValue = "";
$products = array();


$params = array (
            'url'   =>  'https://connect.fiztrade.com',
            'path'  =>  'FizServices',
            'method'=>  '',
            'token' =>  '4103-906cd5f5ebddd4dab583e9a5ec0e414d'
);

//$shopifyConfig = array(
//            'url'       =>  'https://greatamericangold.myshopify.com/',
//            'path'      =>  'admin/products/'.$products['id'].'/images.json',
//            'token'     =>  '62a23c57e44dfcafe8340d432ea37176'
//);


$config = array(
    'ShopUrl'       =>  'greatamericangold.myshopify.com',
    'ApiKey'        =>  '1b8627578b2b9d0896f7392803221e10',
    'token'         =>  '62a23c57e44dfcafe8340d432ea37176'
);

$shopify  = new ShopifySDK($config);

//$products = $shopify->Product->post($productInfo);

//$p = $shopify->Product->get();

//$fiztradeGetProducts = new fiztradeGetProducts($params);
//$fiztradeGetPrices   = new fiztradeGetPrices();
//$fiztradeGetImages   = new fiztradeGetImages();



//  pull all fiztrade products

$params['method'] = "GetProductsByMetalV2";
$fiztradeGetProducts = new fiztradeGetProducts($params);
$goldProducts = json_decode($fiztradeGetProducts->ByMetalType(GOLD));

foreach($goldProducts as $goldProduct){
    $fiztradeGetProducts->buildRecord($goldProduct);

    $params['method'] = "GetCoinImages";
    $fiztradeGetImages   = new fiztradeGetImages($params);
    $goldImages = json_decode($fiztradeGetImages->ByCode($goldProduct->code));
    var_dump($goldImages);
    foreach($goldImages as $goldImage){
        $fiztradeGetImages->buildRecord($goldImage);
    }

    $params['method'] = "GetPrices";
    $fiztradeGetPrices   = new fiztradeGetPrices($params);
    $goldPrices = json_decode($fiztradeGetPrices->ByCode($goldProduct->code));
    $fiztradeGetPrices->buildRecord($goldPrices);

    $p = $shopify->Product->get();
    print_r($p);
    $putArray = array('option1' => 'Yellow', 'price' => '1.00');
    $s = $shopify->Product(4165221548095)->Variant->post($putArray);
    print_r($s);
    $productinfo["title"] = $fiztradeGetProducts->getName();
    $productinfo["body_html"] = "<strong>".$fiztradeGetProducts->getDescription();
    $productinfo["product_type"] = $fiztradeGetProducts->getCategory();
    $productinfo["published_scope"] = "web";
    $productinfo["vendor"] = "Great American Gold";
    $productinfo["tags"] = $fiztradeGetProducts->getCode();
    $products = $shopify->Product->post($productinfo);

//    $productImages = $shopify->Product("#".$products["id"])->Image->post($images);

    $shopifyImage = new shopifyImage($shopifyConfig);
    $imageResult = $shopifyImage->addImage($shopifyConfig);
    echo "<pre>";
    print_r($imageResult);
    echo "</pre>";

    $shopifyConfig = array(
        'url'       =>  'https://greatamericangold.myshopify.com/',
        'path'      =>  'admin/products/'.$products['id'].'/variants.json',
        'token'     =>  '62a23c57e44dfcafe8340d432ea37176'
    );

    $variant = array();

    $variant["title"] = "Default title";
    $variant["price"] = $fiztradeGetPrices->getPriceTier1();
    $variant["fullfilment_service"] = "manual";
    $variant["grams"] = $fiztradeGetProducts->getWeight() * 28.34;
    $variant["inventory_policy"] = "continue";

    $p = $shopify->Product->get();
    print_r($p);

//    $variants = array('option1' => 'Yellow', 'price' => '1.00');
    $shopify->Product($products["id"])->Variant->post($variant);

//    $putArray = array('option1' => 'Yellow', 'price' => '1.00');
//    $shopify->Product(4368899801181)->Variant->post($putArray);

    echo "<pre>";
    print_r($variants);
    echo "</pre>";

    die();

    //            "variants" => array(
//                    "title" => $vTitle,
//                    "price"=> $vPrice,
//                    "position" => 1,
//                    "fulfillment_service" => "manual",
//                    "inventory_management" => null,
//                    "option1" => "Default Title",
//                    "option2" => null,
//                    "option3" => null,
//                    "grams" => 0,
//                    "image_id" => null,
//                    "weight" => $weight,
//                    "weight_unit" => "oz",
//                    "requires_shipping" => true,


//    $token = '62a23c57e44dfcafe8340d432ea37176';
//    $ch = curl_init("https://greatamericangold.myshopify.com/admin/products/".$products['id']."/images.json");
//    $image = json_encode(array('image'=> array('src' => 'https://azrstgp1.blob.core.windows.net/goldimages/half_gram_igr_obv_250x250_jpg')));
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $image);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//        "Content-Type: application/json",
//        "X-Shopify-Access-Token: $token"
//    ));
//    $result = curl_exec($ch);
//    var_dump($result);
//    die();

    //$vendor = "Great American Gold";
    //$vPrice = number_format($fiztradeGetPrices->getPriceTier1(), 2, '.',',');

}


// print_r(json_decode($fiztradeGetProducts->returnJSON));
//print_r($fiztradeGetPrices);
//print_r($fiztradeGetImages);
//print_r($fiztradeGetProducts);
print_r($productinfo);
echo "</pre>";
//$productinfo   =  array(
//            "title" => "",
//            "body_html" => $body_html,
//            "vendor" => $vendor,
//            "product_type" => $product_type,
//            "tags" => $tags,
//            "variants" => array(
//                    "title" => $vTitle,
//                    "price"=> $vPrice,
//                    "position" => 1,
//                    "fulfillment_service" => "manual",
//                    "inventory_management" => null,
//                    "option1" => "Default Title",
//                    "option2" => null,
//                    "option3" => null,
//                    "grams" => 0,
//                    "image_id" => null,
//                    "weight" => $weight,
//                    "weight_unit" => "oz",
//                    "requires_shipping" => true,
//                    "presentment_prices" => array(
//                            "price" => $price,
//                            "currency_code" => "USD",
//                            "amount" => "0.00"
//                    )
//           ),
//            "options"   => array(
//                    "name" => $optionName,
//                    "position" => 1,
//                    "values" => $optionValue
//           ),
//            $images    =>  array(),
//            "image"     => null
//);

//$url = "https://connect.fiztrade.com";
//$path = "";
//$token = "4103-906cd5f5ebddd4dab583e9a5ec0e414d";


//$goldImage = [];
//$goldProduct =[];
//$goldPrice = [];

//        $url = "https://YOUR_API_KEY:YOUR_PASSWORD@YOUR_STORE.myshopify.com/admin/products.json";


//$configParams = array (
//    'Https'      =>     'https://',
//    'ApiKey'     =>     'f228e039662e793f769db44bac35bc73',
//    ':'          =>     ':',
//    'Password'   =>     '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',
//    '@'          =>     '@',
//    'ShopUrl'    =>     'greatamericangold.myshopify.com',
//    'Path'       =>     '/admin'
//);

//$ShopUrl    =      "https://greatamericangold.myshopify.com',
//
//$keys   = array(
//    'ApiKey'     =>     'f228e039662e793f769db44bac35bc73',
//    ''          =>     ':',
//    'Password'   =>     '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',
//    'Path'       =>     '/admin'
//);

//$configParams[]  = "/products.json";
//
//$shopifyProduct = new shopifyProduct($configParams);
//print_r($shopifyProduct->request());
//die();