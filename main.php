<?php
/**
 * Created by PhpStorm.
 * User: webxsys
 * Date: 2/5/20
 * Time: 1:12 AM
 */
session_start();

require __DIR__ . '/vendor/autoload.php';
//require_once(__DIR__ . '/MysqliDb.php');
require __DIR__ . '/fiztradeGetProducts.php';
require __DIR__ . '/fiztradeGetPrices.php';
require __DIR__ . '/fiztradeGetImages.php';
require __DIR__ . '/shopifyProduct.php';
require __DIR__ . '/shopifyImage.php';
require __DIR__ . '/config.class.php';

use PHPShopify\ShopifySDK;

/*
 * setup and initialize variables
 */

printf("Setting up and initializing variables....");
$metalType = array("Gold", "Silver", "Platinum");

define('SEP','/');

$variants = array();
$title  = "";
$body_html = "";
$vendor = "";
$product_type = "";
$tags = "";
$vTitle = "";
$vPrice = "";
$weight = "";
$price = "";
$optionName = "";
$optionValue = "";
$products = array();

/*
 * fiztrade parameters array
 */
echo "\n";
printf("Initializing FIZTRADE parameters array...");

$params = array (
            'url'   =>  'https://connect.fiztrade.com',
            'path'  =>  'FizServices',
            'method'=>  '',
            'token' =>  '4103-906cd5f5ebddd4dab583e9a5ec0e414d'
);

/*
 *   Shopify API auth parameters array
 */
echo "\n";
printf("Initializing SHOPIFY parameters...");


$config = array(
    'ShopUrl'   =>   'greatamericangold.myshopify.com/',
    'ApiKey'    =>   '1b8627578b2b9d0896f7392803221e10',
    'Password'  =>   '62a23c57e44dfcafe8340d432ea37176'
);

/*
 *  instantiate database object and connect
 */
echo "\n";
printf("instantiate database object and connect...");

$configParms = new Config();
$dbConfig = $configParms->get('db');

parse_str(http_build_query($dbConfig));
$db = new Mysqlidb ($host, $user, $pwd, $database);
$appSettings = $db->getOne('appsettings');

parse_str(http_build_query($appSettings));
/*
 *   instantiate  products object & pull all fiztrade products by metal type
 */
echo "\n";
printf("Instantiate products object & pull all FIZTRADE products by metal type");


$params['method'] = "GetProductsByMetalV2";
$fiztradeGetProducts = new fiztradeGetProducts($params);
$goldProducts = json_decode($fiztradeGetProducts->ByMetalType("Gold"));
parse_str(http_build_query($goldProducts));
echo "<pre>";
echo "Products\n";
print_r($goldProducts);
echo "</pre>";

//echo "records processed : ".count($goldProducts)."\n";
$i = 0;
/*
 * Loop through product object and get associated images & price
 */
echo "\n";
printf("Loop through product object & get associated image / pricing data");
 echo "\n";

foreach($goldProducts as $goldProduct) {
    //echo "Records Processed : " . $i . "\n";
    if ($i++ > 2) {
        die();
        break;
    }
    $fiztradeGetProducts->buildRecord($goldProduct);
    $db->where("dg_code",$goldProduct->code);
    $prod = $db->get("stat");
    if($db->count > 0) {
       var_dump($prod);
       echo "duplicate key : " . $goldProduct->code . "\n";
     //  break;
    }else {
        /*
         * get product image(s)`
         */
        $params['method'] = "GetCoinImages";

        $fiztradeGetImages = new fiztradeGetImages($params);
        $goldImages = json_decode($fiztradeGetImages->ByCode($goldProduct->code));
        echo "<pre>";
        echo "Images\n";
        print_r($goldImages);
        echo "</pre>";
        parse_str(http_build_query($goldProducts));

        foreach ($goldImages as $goldImage) {
            $fiztradeGetImages->buildRecord($goldImage);
            //$fiztradeGetImages->setImageURL($goldImage->imageURL);
        }
        /*
         * get product price(s)`
         */

        $params['method'] = "GetPrices";
        $fiztradeGetPrices = new fiztradeGetPrices($params);
        $goldPrices = json_decode($fiztradeGetPrices->ByCode($goldProduct->code));
        echo "<pre>";
        echo "Prices\n";
        print_r($goldPrices);
        echo "</pre>";
        parse_str(http_build_query($goldPrices));
        $fiztradeGetPrices->buildRecord($goldPrices);


        /*
         * build product record for shopify
         */
        printf("building product record for shopify product creation");
        $productinfo["title"] = $fiztradeGetProducts->getName();
        $productinfo["body_html"] = $fiztradeGetProducts->getDescription();
        $productinfo["product_type"] = $fiztradeGetProducts->getCategory();
        $productinfo["published_scope"] = "web";
        $productinfo["vendor"] = "Great American Gold";
        //$productinfo["tags"] = $fiztradeGetProducts->getCode();

        /*
         * instantiate shopify sdk wrapper object & create shopify product
         */
        $shopify = new ShopifySDK($config);
        $products = $shopify->Product->post($productinfo);
        echo "<pre>";
        echo "record build\n";
        print_r($products["variants"][0]);
        echo "</pre>";
        parse_str(http_build_query($products["variants"][0]));

        echo "id : " . $id . "\n";
        echo "product id : " . $product_id . "\n";
        $db_sp_id = $product_id;
        $db_variant_id = $id;
        $variant_id = $id;
        //$product_id = $products["variants"][0][1];
        //echo "\nvariants id : ".$products["variants"][0]["id"]."\n";

        /*
         * shopify configuration parameters array
         */
        $shopifyImageConfig = array(
            'url' => 'https://greatamericangold.myshopify.com/',
            'path' => 'admin/products/' . $product_id . '/images.json',
            'token' => '62a23c57e44dfcafe8340d432ea37176'
        );
        /*
         * instantiate shopify object for image transfer
         */
        $shopifyImage = new shopifyImage($shopifyImageConfig);
        $imageResult = $shopifyImage->addImage($shopifyImageConfig, $fiztradeGetImages->getImageURL());

        //parse_str(http_build_query($imageResult));
        echo "<pre>";
        echo "Image Add\n";
        print_r($imageResult);
        echo "</pre>";
        $data = array(
            'product' => array(
                'id' => $product_id,
                'variant' => array(
                    'id' => $variant_id,
                    'price' => $fiztradeGetPrices->getPriceTier1()
                )
            )
        );

        $apikey = $config['ApiKey'];
        $pass = $config['Password'];

        $url = "https://" . $apikey . ":" . $pass . "@greatamericangold.myshopify.com/admin/products/" . $product_id . ".json";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            echo "errno : " . $curl_errno($curl) . " : " . $curl_strerror($curl_errno($curl)) . "\n";
            die();
        }

        /*
         * store quick check data in database table
         */


        $dbData = array(
            'sp_id'         => $product_id,
            'variant1_id'   => $variant_id,
            'dg_code'       => $goldProduct->code,
            'activeSell'    => $isActiveSell,
            'isAvailable'   => $availability,
            'tier1_price'   => $fiztradeGetPrices->getPriceTier1()
        );
        $stat_id = $db->insert("stat", $dbData);

        if ($stat_id) {
            echo "success";
        } else {
            echo "failure to insert database record : " . $db->getLastError();
        }

        unset($dbData);

        $dbData = array(
            'sp_id'         =>  $product_id,
            'dg_code'       =>  $goldProduct->code,
            'name'          =>  $goldProduct->name,
            'metalType'     =>  $goldProduct->metalType,
            'description'   =>  $goldProduct->description,
            'weight'        =>  $goldProduct->weight,
            'category'      =>  $goldProduct->category
        );
        $product_id = $db->insert("product", $dbData);

        if ($product_id) {
            echo "success";
        } else {
            echo "failure to insert database record : " . $db->getLastError();
        }

        unset($dbData);

        $dbData = array(
            'dg_code'       =>  $fiztradeGetImages->getCode(),
            'imageURL'      =>  $fiztradeGetImages->getImageURL(),
            'imageSmallURL' =>  $fiztradeGetImages->getImageSmallURL()
        );
        $image_id = $db->insert("imageloc", $dbData);

        if ($image_id) {
            echo "success";
        }else{
            echo "failure to insert database record <imageLoc> : " . $db->getLastError();
        }


        echo "<pre>";
        echo "Database\n";
        print_r($stat_id);
        echo "</pre>";
    }
}






function kickout(){
    $target = "";
    $args = func_get_args();
    $format = array_shift($args);

    $output = "<pre>".$target."</pre>";
    echo $output;
}