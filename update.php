<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 3/3/2020
 * Time: 11:37 PM
 */
session_start();

/*
if(!isset($_SESSION['authenticated'])){
    header('Location: login.php');
    exit;
}

$userObject = unserialize($_SESSION['userObject']);
if(isset($_SESSION['user_realname'])) {
    $realname = $_SESSION['user_realname'];
}
*/

echo "\n[SHOPIFY SHOW UPDATE] ".date("F j, Y, g:i a")." ";

require '/opt/bitnami/apache2/htdocs/repo/vendor/autoload.php';
require '/opt/bitnami/apache2/htdocs/repo/config.class.php';
require '/opt/bitnami/apache2/htdocs/repo/price.class.php';
require '/opt/bitnami/apache2/htdocs/repo/shopifyPrice.php';

use PHPShopify\ShopifySDK;

$config = new Config();
$dbConfig = $config->get('db');
@parse_str(http_build_query($dbConfig));

$db = new Mysqlidb ($host, $user, $pwd, $database);

$appSettings = $db->getOne('appsettings');
@parse_str(http_build_query($appSettings));

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

$shopify = new ShopifySDK($shopifyConfig);
$data = array(
    'product' => array(
        'id' => $product['sp_id'],
        'variant' => array(
            'id' => $product['variant1_id'],
            'aprice' => $bPrice
        )
    )
);
$url = "https://" . $shopifyApiKey . ":" . $shopifyPassword . "@greatamericangold.myshopify.com/admin/products/" . $product['dg_code'] . ".json";
echo "\n[SHOPIFY UPDATED] ".$product['dg_code']."  ".date("F j, Y, g:i a")."\n";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
if (curl_errno($curl)) {
    error_log("[ERROR] errno : " . $curl_errno($curl) . " : " . $curl_strerror($curl_errno($curl)));
    die();
}
}
};