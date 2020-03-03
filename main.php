<?php
/**
 * Created by PhpStorm.
 * User: webxsys
 * Date: 2/5/20
 * Time: 1:12 AM
 */
session_start();


require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/fiztradeGetProducts.php';
require __DIR__ . '/fiztradeGetPrices.php';
require __DIR__ . '/fiztradeGetImages.php';
require __DIR__ . '/shopifyProduct.php';
require __DIR__ . '/shopifyImage.php';
require __DIR__ . '/config.class.php';

//
//require '/opt/bitnami/apache2/htdocs/repo/vendor/autoload.php';
//require '/opt/bitnami/apache2/htdocs/repo/config.class.php';
//require '/opt/bitnami/apache2/htdocs/repo/fiztradeGetProducts.php';
//require '/opt/bitnami/apache2/htdocs/repo/fiztradeGetPrices.php';
//require '/opt/bitnami/apache2/htdocs/repo/fiztradeGetImages.php';
//require '/opt/bitnami/apache2/htdocs/repo/shopifyProduct.php';
//require '/opt/bitnami/apache2/htdocs/repo/shopifyImage.php';


use PHPShopify\ShopifySDK;

/*
 * setup and initialize variables
 */

$metalType = array("Gold", "Silver", "Platinum", "Palladium");

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
$response = array();
$error = array();

$response[] = "Setting up and initializing variables....";

/*
 * fiztrade parameters array
 */

$response[] = "Initializing FIZTRADE parameters array...";

$params = array (
    'url'   =>  'https://connect.fiztrade.com',
    'path'  =>  'FizServices',
    'method'=>  '',
    'token' =>  '4103-906cd5f5ebddd4dab583e9a5ec0e414d'
);

/*
 *   Shopify API auth parameters array
 */

$response[] = "Initializing SHOPIFY parameters...";

$config = array(
    'ShopUrl'   =>   'greatamericangold.myshopify.com/',
    'ApiKey'    =>   '1b8627578b2b9d0896f7392803221e10',
    'Password'  =>   '62a23c57e44dfcafe8340d432ea37176'
);

/*
 *  instantiate database object and connect
 */

$response[] = "instantiate database object and connect...";

$configParms = new Config();
$dbConfig = $configParms->get('db');
parse_str(http_build_query($dbConfig));

$db = new Mysqlidb ($host, $user, $pwd, $database);

$appSettings = $db->getOne('appsettings');
parse_str(http_build_query($appSettings));

$rateConfig = $configParms->get('pricing');
parse_str(http_build_query($rateConfig));

/*
 *   instantiate  products object & pull all fiztrade products by metal type
 */

$response[] = "Instantiate products object & pull all FIZTRADE products by metal type";

$params['method'] = "GetProductsByMetalV2";
$fiztradeGetProducts = new fiztradeGetProducts($params);
$goldProducts = json_decode($fiztradeGetProducts->ByMetalType("Gold"));
parse_str(http_build_query($goldProducts));
$i = 0;
/*
 * Loop through product object and get associated images & price
 */


$response[] = "Loop through product object & get associated image / pricing data";

foreach($goldProducts as $goldProduct) {
    $fiztradeGetProducts->buildRecord($goldProduct);
    $db->where("dg_code", $goldProduct->code);
    $prod = $db->get("stat");
    if ($db->count > 0) {
//        $response[] = "duplicate key : " . $goldProduct->code;
        echo "duplicate key : " . $goldProduct->code . "\n";

        continue;
    } else {
        if ($i++ > 3) {
            break;
        }
        $params['method'] = "GetCoinImages";
        $fiztradeGetImages = new fiztradeGetImages($params);
        $goldImages = json_decode($fiztradeGetImages->ByCode($goldProduct->code));
        parse_str(http_build_query($goldProducts));

        foreach ($goldImages as $goldImage) {
            $fiztradeGetImages->buildRecord($goldImage);
        }
        $params['method'] = "GetPrices";
        $fiztradeGetPrices = new fiztradeGetPrices($params);
        $goldPrices = json_decode($fiztradeGetPrices->ByCode($goldProduct->code));

        //error_log(print_r($goldPrices),true);

        parse_str(http_build_query($goldPrices));
        $fiztradeGetPrices->buildRecord($goldPrices);

        $response[] = "building product record for shopify product creation";
        $productinfo["title"] = $fiztradeGetProducts->getName();
        $productinfo["body_html"] = $fiztradeGetProducts->getDescription();
        $productinfo["product_type"] = $fiztradeGetProducts->getCategory();
        $productinfo["published_scope"] = "web";
        $productinfo["vendor"] = "Great American Gold";
        //$productinfo["tags"] = $fiztradeGetProducts->getCode();

        $shopify = new ShopifySDK($config);
        $products = $shopify->Product->post($productinfo);
        parse_str(http_build_query($products["variants"][0]));
        $db_sp_id = $product_id;
        $db_variant_id = $id;
        $variant_id = $id;

        $shopifyImageConfig = array(
            'url' => 'https://greatamericangold.myshopify.com/',
            'path' => 'admin/products/' . $product_id . '/images.json',
            'token' => '62a23c57e44dfcafe8340d432ea37176'
        );

        $shopifyImage = new shopifyImage($shopifyImageConfig);
        $imageResult  = $shopifyImage->addImage($shopifyImageConfig, $fiztradeGetImages->getImageURL());
        $basePrice    = get_percentage($fiztradeGetPrices->getPriceTier1(), $basePercentage);
        $tier1Price   = get_percentage($fiztradeGetPrices->getPriceTier1(), $tier1Percentage);
        $tier2Price   = get_percentage($fiztradeGetPrices->getPriceTier2(), $tier2Percentage);
        $tier3Price   = get_percentage($fiztradeGetPrices->getPriceTier3(), $tier3Percentage);
        $tier4Price   = get_percentage($fiztradeGetPrices->getPriceTier4(), $tier4Percentage);

        $ia = $fiztradeGetPrices->getisActiveSell();
        $pr = $fiztradeGetPrices->getPriceTier1();
//        if($isActiveSell == "Y" && $basePrice > 0) {



        if($ia == "Y" && $pr > 0){
            unset($data);
//            echo "\n".$goldProduct->code . " isActive : ".$ia."  :  "."basePrice : ".$pr."\n";
            $data = array(
                'product' => array(
                    'id' => $product_id,
                    'variant' => array(
                        'id' => $variant_id,
                        'price' => $basePrice
                    )
                )
            );

            $apikey = $config['ApiKey'];
            $pass = $config['Password'];

            $url = "https://" . $apikey . ":" . $pass . "@greatamericangold.myshopify.com/admin/products/" . $product_id . ".json";


            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $response[] = curl_exec($curl);
            if (curl_errno($curl)) {
                $response[] = "errno : " . $curl_errno($curl) . " : " . $curl_strerror($curl_errno($curl)) . "\n";
//                echo json_encode($response);
            }

            $dbData = array(
                'sp_id' => $product_id,
                'variant1_id' => $variant_id,
                'dg_code' => $goldProduct->code,
                'activeSell' => $isActiveSell,
                'isAvailable' => $availability,
                'basePrice' => $basePrice
            );
            $stat_id = $db->insert("stat", $dbData);

            if ($stat_id) {
                $response[] = "success";
            } else {
                $response[] = "failure to insert database record : " . $db->getLastError();
//                echo json_encode($response);
            }

            unset($dbData);

            $dbData = array(
                'sp_id' => $product_id,
                'dg_code' => $goldProduct->code,
                'name' => $goldProduct->name,
                'metalType' => $goldProduct->metalType,
                'description' => $goldProduct->description,
                'weight' => $goldProduct->weight,
                'category' => $goldProduct->category,
                'tier1_price' => $tier1Price,
                'tier2_price' => $tier2Price,
                'tier3_price' => $tier3Price,
                'tier4_price' => $tier4Price
            );
            $product_id = $db->insert("product", $dbData);

            if ($product_id) {
                $response[] = "success";
            } else {
                $response[] = "failure to insert database record : " . $db->getLastError();
//                echo json_encode($response);
            }

            unset($dbData);

            $dbData = array(
                'dg_code' => $fiztradeGetImages->getCode(),
                'imageURL' => $fiztradeGetImages->getImageURL(),
                'imageSmallURL' => $fiztradeGetImages->getImageSmallURL()
            );
            $image_id = $db->insert("imageloc", $dbData);

            if ($image_id) {
                $response[] = "success";
            } else {
                $response[] = "failure to insert database record : " . $db->getLastError();
//                echo json_encode($response);
            }
// 			if ($i++ > 3) {
//        		break;
//    		}
        }
    }
}
//error_log(print_r(json_encode($response)),true);
//$return = json_encode($response);
//echo $return;


function get_percentage($total, $number){
    if ($total > 0){
        $perc = $number / ($total / 100);
        return $total + $perc;
    }else{
        return 0;
    }
}


function kickout(){
    $target = "";
    $args = func_get_args();
    $format = array_shift($args);

    $output = "<pre>".$target."</pre>";
    echo $output;
}