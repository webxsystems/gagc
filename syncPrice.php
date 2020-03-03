<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/16/2020
 * Time: 8:24 PM
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

echo "\n[START RUN] ".date("F j, Y, g:i a")." ";

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

$rateConfig = $config->get('pricing');
@parse_str(http_build_query($rateConfig));

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

$params['method'] = "GetPrice";

$syncPrice = new Price($params);
$products = $db->get('stat');

foreach($products as $product) {
    //$goldPrices = json_decode($fiztradeGetPrice->ByCode($product['dg_code']));
    $goldPrices = json_decode($syncPrice->GetPrice($product['dg_code']));
    @parse_str(http_build_query($goldPrices));
    @parse_str(http_build_query($product));

    $convPrice = 0;
    $pos = 0;
    $pos = strpos($goldPrices->ask, '.');
    if($pos === false){
        $convPrice = sprintf('%0.2f', $goldPrices->ask);
    }else {
        if (strpos($goldPrices->ask, '.') == 3) {
            $convPrice = sprintf('%0.2f', $goldPrices->ask);
        } else {
            if (strpos($goldPrices->ask, '.') == 2) {
                $convPrice = sprintf('%0.2f', $goldPrices->ask);
            } else {
                if (strpos($goldPrices->ask, '.') == 1 && strlen($goldPrices->ask) == 3) {
                    $convPrice = sprintf('%0.2f', $goldPrices->ask);
                }else{
                    $convPrice = $goldPrices->ask;
                }
            }
        }
    }

    $bPrice    = get_percentage($convPrice, $basePercentage);
    $t1Price   = get_percentage($convPrice, $tier1Percentage);
    $t2Price   = get_percentage($convPrice, $tier2Percentage);
    $t3Price   = get_percentage($convPrice, $tier3Percentage);
    $t4Price   = get_percentage($convPrice, $tier4Percentage);

    if(($convPrice != $origPrice) || ($convPrice == 0) || ($activeSell != $isActiveSell)){
        echo "\n[TRIGGER] existing price : " . $origPrice . " new price : " . $convPrice . "\n";
        $data = array(
            'activeSell'    => $isActiveSell,
            'isAvailable'   => $availability,
            'origPrice'     => $convPrice,
            'basePrice'     => $bPrice
        );
        $db->where("dg_code", $product['dg_code']);
        if ($db->update('stat', $data)){
            echo "\n[SUCCESS] ".$product['dg_code'] . ": stat table updated " .date("F j, Y, g:i a")."\n";
        } else {
            echo "[ERROR] failed to update price or availability ".date("F j, Y, g:i a")."\n";
        }
        unset($data);
        $data = array(
            'tier1_price'   =>  $t1Price,
            'tier2_price'   =>  $t2Price,
            'tier3_price'   =>  $t3Price,
            'tier4_price'   =>  $t4Price
        );
        $db->where("dg_code", $product['dg_code']);
        if($db->update('product', $data)){
            echo "[SUCCESS] ".$product['dg_code'] . ": product table updated " .date("F j, Y, g:i a")."\n";
        } else {
            echo "[ERROR] failed to update price or availability ".date("F j, Y, g:i a")."\n";
        }
        $shopify = new ShopifySDK($shopifyConfig);
        $data = array(
            'product' => array(
                'id' => $product['sp_id'],
                'variant' => array(
                    'id' => $product['variant1_id'],
                    'price' => $bPrice
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

echo "[END RUN] ".date("F j, Y, g:i a");

function get_percentage($total, $percentage){
    if ($total > 0){
        $number = round($total * ($percentage / 100), 2 );
        return $total + $number;
    }else{
        return 0;
    }
};

