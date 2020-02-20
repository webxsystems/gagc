<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/16/2020
 * Time: 8:24 PM
 */
session_start();

//require_once(__DIR__ . '/MysqliDb.php');
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.class.php';
require __DIR__ . '/fiztradeGetPrices.php';
require __DIR__ . '/shopifyPrice.php';

use PHPShopify\ShopifySDK;

//$code = '.5GRGBIGR';

/*
 *  instantiate database object and connect
 */
$config = new Config();
$dbConfig = $config->get('db');

parse_str(http_build_query($dbConfig));
$db = new Mysqlidb ($host, $user, $pwd, $database);
$appSettings = $db->getOne('appsettings');

parse_str(http_build_query($appSettings));

//  pull list of products on shopify
$products = $db->get('stat');
echo "<pre>";
print_r($products);
echo "</pre>";
$params = array (
        'url'       =>  $fizURL,
        'path'      =>  $fizPath,
        'method'    =>  '',
        'token'     =>  $fizToken
);


$shopifyConfig = array(
    'ShopUrl'   =>   'greatamericangold.myshopify.com/',
    'ApiKey'    =>   '1b8627578b2b9d0896f7392803221e10',
    'Password'  =>   '62a23c57e44dfcafe8340d432ea37176'
);

$params['method'] = "GetPrices";
$fiztradeGetPrice = new fiztradeGetPrices($params);

foreach($products as $product) {
    $goldPrices = json_decode($fiztradeGetPrice->ByCode($product['dg_code']));
    echo "<pre>";
    print_r($goldPrices);
    echo "</pre>";
    parse_str(http_build_query($goldPrices));
    $price = $tiers[1]['ask'];
    if (($product['tier1_price'] != $price) || ($isActiveSell != $product['activeSell']) || ($product['isAvailable'] != $availability)) {
        $data = array(
            'activeSell' => $isActiveSell,
            'isAvailable' => $availability,
            'tier1_price' => $price
        );
        $db->where("dg_code", $product['dg_code']);
        if ($db->update('stat', $data)){
            error_log($product['dg_code'] . ': record updated');
        } else {
            echo "failed to update price or availability ";
        }
        $shopify = new ShopifySDK($shopifyConfig);
        $data = array(
            'product' => array(
                'id' => $product['sp_id'],
                'variant' => array(
                    'id' => $product['variant1_id'],
                    'price' => $price
                )
            )
        );
        $url = "https://" . $shopifyApiKey . ":" . $shopifyPassword . "@greatamericangold.myshopify.com/admin/products/" . $product['dg_code'] . ".json";
        echo $url . "<br>";
        //$addPrice = $shopify->addPrice($url);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            echo "errno : " . $curl_errno($curl) . " : " . $curl_strerror($curl_errno($curl)) . "\n";
            die();
        }
    }
};






















/*
 * update shopify product
 */
