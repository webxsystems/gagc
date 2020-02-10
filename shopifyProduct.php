<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 2/9/2020
 * Time: 2:54 AM
 */

class shopifyProduct
{
    public $c;
    public $url;
    public $jsonResponse;
    public $config;
    public $params;
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

    public function __construct($configParams)
    {
//        $this->config = array(
//                          'Https'      =>      'https:/',
//                          'ShopUrl'    =>      'greatamericangold.myshopify.com',
//                          'Path'       =>      'admin',
//                          'Keys'       => array(
//                                            'ApiKey'     =>     'f228e039662e793f769db44bac35bc73',
//                                            '@'          =>     '@',
//                                            'Password'   =>     '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'
//                          )
//        );
    $this->url = implode("", $configParams);
    echo $this->url."\n\n";


        // PHPShopify\ShopifySDK::config($this->config);
    }

    public function request(){
       // echo $this->url."\n\n";
//        $url = "https://YOUR_API_KEY:YOUR_PASSWORD@YOUR_STORE.myshopify.com/admin/products.json";
//        $curl = curl_init( $url );
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        $json_response = curl_exec($curl);
//        curl_close($curl);
//        $result = json_decode($json_response, TRUE);
//        $array["product"]["title"] = 'Test Title';
//        $array["product"]["body_html"] = 'Test Body';
//        $p = json_encode($array);
//        $c  =   curl_init( $this->url );
//        curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($p));
//        curl_setopt($c, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
//        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
//        $this->jsonResponse = curl_exec($c);
//        curl_close($c);
//        return $this->jsonResponse;
    }

}