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

use PHPShopify\ShopifySDK;

define('GOLD', 'gold');
define('SILVER', 'silver');
define('PLATINUM', 'platinum');


$config = array(
    'ShopUrl'       =>  'greatamericangold.myshopify.com',
    'ApiKey'        =>  '1b8627578b2b9d0896f7392803221e10',
    'Password'      =>  '62a23c57e44dfcafe8340d432ea37176'
);

$shopify  = new ShopifySDK($config);
$fiztradeGetProducts = new fiztradeGetProducts();
$fiztradeGetPrices   = new fiztradeGetPrices();
$fiztradeGetImages   = new fiztradeGetImages();



//  pull all fiztrade products

$goldProducts = json_decode($fiztradeGetProducts->ByMetalType($metalType));




















s