<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/17/2020
 * Time: 2:03 AM
 */

PHPShopify\ShopifySDK::config($config);
$accessToken = \PHPShopify\AuthHelper::createAuthRequest($scopes);
//Now store it in database or somewhere else