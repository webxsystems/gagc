<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/29/2020
 * Time: 9:02 PM
 */

include('../vendor/phpclassic/php-shopify/lib/ShopifySDK.php');


class shopifyCreateProduct
{
    public $config;

    public function __construct()
    {
        $this->config = array(
            'ShopUrl'       =>  'greatamericangold',
            'ApiKey'        =>  'f228e039662e793f769db44bac35bc73',
            'Password'      =>  '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'
        );
        PHPShopify\ShopifySDK::config($this->config);
    }



}