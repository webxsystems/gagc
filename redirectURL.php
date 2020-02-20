<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/17/2020
 * Time: 1:57 AM
 */




$config = array(
    'ShopUrl' => '',
    'ApiKey' => '',
    'SharedSecret' => '',
);

PHPShopify\ShopifySDK::config($config);
$accessToken = \PHPShopify\AuthHelper::getAccessToken();
//Now store it in database or somewhere else