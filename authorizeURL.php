<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/17/2020
 * Time: 2:00 AM
 */


$config = array(
    'ShopUrl' => '',
    'ApiKey' => '',
    'SharedSecret' => '',
);

$scopes = 'read_products,write_products,read_script_tags,write_script_tags';
//This is also valid
//$scopes = array('read_products','write_products','read_script_tags', 'write_script_tags');
$redirectUrl = 'https://yourappurl.com/your_redirect_url.php';

\PHPShopify\AuthHelper::createAuthRequest($scopes, $redirectUrl);