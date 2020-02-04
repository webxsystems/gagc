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
    public $title;     
    public $body_html;   
    public $vendor;   
    public $product_type;   
    public $created_at;   
    public $handle;   
    public $updated_at;   
    public $published_at;   
    public $template_suffix;   
    public $published_scope;   
    public $tags;   
    public $admin_graphql_api_id;
    public $variants = array();
    public $vTitle;
    public $vPrice;
    public $vSku;
    public $vPosition;
    public $vInventory_policy;
    public $Compare_at_price;
 fulfillment_service
 inventory_management
 optio1
 option2
 option3
 created_at
 updated_at
 taxable
 barcode
 grams
 image_id
 weight
 weight_unit
 inventory_item_id
 inventory_quantity
 old_inventory_quantity
 requires_shipping
 admin_graphql_api_id
)

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