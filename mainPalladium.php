<?php

/**

 * Created by PhpStorm.

 * User: webxsys

 * Date: 2/5/20

 * Time: 1:12 AM

 */

session_start();





/*require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/fiztradeGetProducts.php';

require __DIR__ . '/fiztradeGetPrices.php';

require __DIR__ . '/fiztradeGetImages.php';

require __DIR__ . '/shopifyProduct.php';

require __DIR__ . '/shopifyImage.php';

require __DIR__ . '/config.class.php';*/





require 'vendor/autoload.php';

require 'config.class.php';

require 'fiztradeGetProducts.php';

require 'fiztradeGetPrices.php';

require 'fiztradeGetImages.php';

require 'shopifyProduct.php';

require 'shopifyImage.php';





use PHPShopify\ShopifySDK;



/*

 * setup and initialize variables

 */



$metalType = array("Gold", "Silver", "Platinum", "Palladium");



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

$response = array();

$error = array();

$tier2Price = 0;

$tier3Price = 0;

$tier4Price = 0;

//$basePrice = 0;

$number = 0;





echo "Setting up and initializing variables....<br>";



/*

 * fiztrade parameters array

 */



echo "Initializing FIZTRADE parameters array...<br>";



$params = array (

    'url'   =>  'https://connect.fiztrade.com',

    'path'  =>  'FizServices',

    'method'=>  '',

    'token' =>  '4103-906cd5f5ebddd4dab583e9a5ec0e414d'



);



/*

 *   Shopify API auth parameters array

 */



echo  "Initializing SHOPIFY parameters...<br>";



$config = array(

    'ShopUrl'   =>   'greatamericangold.myshopify.com/',

    'ApiKey'    =>   '1b8627578b2b9d0896f7392803221e10',

    'Password'  =>   '62a23c57e44dfcafe8340d432ea37176'

);



/*

 *  instantiate database object and connect

 */



echo  "instantiate database object and connect...<br>";



$configParms = new Config();

$dbConfig = $configParms->get('db');

@parse_str(http_build_query($dbConfig));



$db = new Mysqlidb ($host, $user, $pwd, $database);



$appSettings = $db->getOne('appsettings');

@parse_str(http_build_query($appSettings));



$rateConfig = $configParms->get('pricing');

@parse_str(http_build_query($rateConfig));



/*

 *   instantiate  products object & pull all fiztrade products by metal type

 */



echo  "Instantiate products object & pull all FIZTRADE products by metal type<br>";



$params['method'] = "GetProductsByMetalV2";

$fiztradeGetProducts = new fiztradeGetProducts($params);

$goldProducts = json_decode($fiztradeGetProducts->ByMetalType("Palladium"));

//echo "<pre>";

//print_r($goldProducts);

//echo "</pre>";



@parse_str(http_build_query($goldProducts));

$i = 0;

$dupCount = 0;

$activeSellCount = 0;

$priceZeroCount = 0;

/*

 * Loop through product object and get associated images & price

 */

echo  "Loop through product object & get associated image / pricing data<br>";



foreach($goldProducts as $goldProduct) {

    $fiztradeGetProducts->buildRecord($goldProduct);

    $db->where("dg_code", $goldProduct->code);

    $prod = $db->get("stat");

    if ($db->count > 0) {

        //echo "\nduplicate product : " . $goldProduct->code . "<br>\n";

        $dupCount++;

        continue;

    } else {

        if ($i++ > 500) {

            die();

        }

        //$params['method'] = "GetPrices";

        $fiztradeGetPrice = new fiztradeGetPrices($params);

        // $goldPrices = json_decode($fiztradeGetPrices->ByCode($goldProduct->code));

        $goldPrices = json_decode($fiztradeGetPrice->GetPrice($goldProduct->code));

        @parse_str(http_build_query($goldPrices));

        $ia = $isActiveSell;

        $pr = $goldPrices->ask;

        if ($isActiveSell) $activeSellCount++;

        if ($pr == 0){ $priceZeroCount++;};

//        echo "isActiveSell : ".$ia."  -  goldPrice : ".$pr."<br>";

        if($ia == "Y" && $pr > 0){

            $convPrice = 0;

            //echo strpos($basePrice, '.')

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



            echo "price : ".$pr." : ".$convPrice."\n<br>";

            $fiztradeGetPrice->buildRecord($convPrice);



            // $bprice    = get_percentage($fiztradeGetPrice->getPriceTier1(), $basePercentage);





            $basePrice = get_percentage($convPrice, $basePercentage);

            $t1Price   = get_percentage($fiztradeGetPrice->getPriceTier1(), $tier1Percentage);

            $t2Price   = get_percentage($fiztradeGetPrice->getPriceTier2(), $tier2Percentage);

            $t3Price   = get_percentage($fiztradeGetPrice->getPriceTier3(), $tier3Percentage);

            $t4Price   = get_percentage($fiztradeGetPrice->getPriceTier4(), $tier4Percentage);



            echo "\n".$goldPrices->ask." : ".$basePrice." : ".$t1Price." : ".$t2Price." : ".$t3Price."\n<br>";



            $params['method'] = "GetCoinImages";

            $fiztradeGetImages = new fiztradeGetImages($params);

            $goldImages = json_decode($fiztradeGetImages->ByCode($goldProduct->code));

            @parse_str(http_build_query($goldProducts));



            foreach ($goldImages as $goldImage) {

                $fiztradeGetImages->buildRecord($goldImage);

            }

            //        $params['method'] = "GetPrices";

            //        $fiztradeGetPrice = new fiztradeGetPrices($params);

            //       // $goldPrices = json_decode($fiztradeGetPrices->ByCode($goldProduct->code));

            //        $goldPrices = json_decode($fiztradeGetPrice->GetPrice($goldProduct->code));

            //        parse_str(http_build_query($goldPrices));

            //        var_dump($goldPrices);

            //

            //        $ia = $isActiveSell;

            //        $pr = $goldPrices->ask;

            //

            //        echo "Price : ".$goldPrices->ask;

            //        $pos = 0;

            //        $pos = strpos($goldPrices->ask, '.');

            //        if($pos === false){

            //            $basePrice = sprintf('%0.2f', $goldPrices->ask);

            //        }

            //        if(strpos($goldPrices->ask, '.') == 3){

            //            $basePrice = sprintf('%0.2f', $goldPrices->ask);

            //        }

            //        if(strpos($goldPrices->ask, '.') == 2){

            //            $basePrice = sprintf('%0.2f', $goldPrices->ask);

            //        }

            //        if(strpos($goldPrices->ask, '.') == 1 && strlen($goldPrices->ask) == 3){

            //            $basePrice = sprintf('%0.2f', $goldPrices->ask);

            //        }

            //

            //        echo "  basePrice : ".$basePrice."\n";

            //        $fiztradeGetPrice->buildRecord($basePrice);



            //error_log(print_r($goldPrices),true);



            // @parse_str(http_build_query($goldPrices));

            // $fiztradeGetPrice->buildRecord($goldPrices);



            echo "building product record for shopify product creation<br>";

            $productinfo["title"] = $fiztradeGetProducts->getName();

            $productinfo["body_html"] = $fiztradeGetProducts->getDescription();

            $productinfo["product_type"] = $fiztradeGetProducts->getCategory();

            $productinfo["published_scope"] = "web";

            $productinfo["vendor"] = "Great American Gold";

            //$productinfo["tags"] = $fiztradeGetProducts->getCode();



            $shopify = new ShopifySDK($config);

            $products = $shopify->Product->post($productinfo);

            @parse_str(http_build_query($products["variants"][0]));

            $db_sp_id = $product_id;

            $db_variant_id = $id;

            $variant_id = $id;



            $shopifyImageConfig = array(

                'url' => 'https://greatamericangold.myshopify.com/',

                'path' => 'admin/products/' . $product_id . '/images.json',

                'token' => '62a23c57e44dfcafe8340d432ea37176'

            );



            $shopifyImage = new shopifyImage($shopifyImageConfig);

            $imageResult  = $shopifyImage->addImage($shopifyImageConfig, $fiztradeGetImages->getImageURL());



//            $bprice    = get_percentage($fiztradeGetPrice->getPriceTier1(), $basePercentage);

//            $tier1Price   = get_percentage($fiztradeGetPrice->getPriceTier1(), $tier1Percentage);

//            $tier2Price   = get_percentage($fiztradeGetPrice->getPriceTier2(), $tier2Percentage);

//            $tier3Price   = get_percentage($fiztradeGetPrice->getPriceTier3(), $tier3Percentage);

//            $tier4Price   = get_percentage($fiztradeGetPrice->getPriceTier4(), $tier4Percentage);

//



            // $ia = $fiztradeGetPrice->getisActiveSell();

            // $pr = $fiztradeGetPrice->getPriceTier1();

            //        if($isActiveSell == "Y" && $basePrice > 0) {







            //        if($ia == "Y" && $pr > 0){

            unset($data);

            //            echo "\n".$goldProduct->code . " isActive : ".$ia."  :  "."basePrice : ".$pr."\n";

            $data = array(

                'product' => array(

                    'id' => $product_id,

                    'variant' => array(

                        'id' => $variant_id,

                        'price' => $t1Price

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

            $response[] = curl_exec($curl);

            if (curl_errno($curl)) {

                echo "errno : " . $curl_errno($curl) . " : " . $curl_strerror($curl_errno($curl)) . "\n<br>";

                //                echo json_encode($response);

            }



            $dbData = array(

                'sp_id' => $product_id,

                'variant1_id' => $variant_id,

                'dg_code' => $goldProduct->code,

                'activeSell' => $isActiveSell,

                'isAvailable' => $availability,

                'origPrice' => $goldPrices->ask,

                'basePrice' => $basePrice

            );

            $stat_id = $db->insert("stat", $dbData);

            echo "<br>";

            if ($stat_id) {

                echo "Product successfully added to 'Stat' table.<br>";

            } else {

                echo "failure to insert database record : " . $db->getLastError() . "<br>";

                //                echo json_encode($response);

            }



            unset($dbData);



            $dbData = array(

                'sp_id' => $product_id,

                'dg_code' => $goldProduct->code,

                'name' => $goldProduct->name,

                'metalType' => $goldProduct->metalType,

                'description' => $goldProduct->description,

                'weight' => $goldProduct->weight,

                'category' => $goldProduct->category,

                'tier1_price' => $t1Price,

                'tier2_price' => $t2Price,

                'tier3_price' => $t3Price,

                'tier4_price' => $t4Price

            );

            $product_id = $db->insert("product", $dbData);



            if ($product_id) {

                echo "Product successfully added to 'Product' table.<br>";

            } else {

                echo "failure to insert database record : " . $db->getLastError() . "<br>";

                //                echo json_encode($response);

            }



            unset($dbData);



            $dbData = array(

                'dg_code' => $fiztradeGetImages->getCode(),

                'imageURL' => $fiztradeGetImages->getImageURL(),

                'imageSmallURL' => $fiztradeGetImages->getImageSmallURL()

            );

            $image_id = $db->insert("imageloc", $dbData);



            if ($image_id) {

                echo "Product successfully added to 'Imageloc' table.<br>";

            } else {

                echo "failure to insert database record : " . $db->getLastError() . "<br>";

            }



        }

    }

}



echo count($goldProducts)." products pulled <br>";

echo $priceZeroCount." products with $0.00 price<br>";

echo count($goldProducts) - $activeSellCount." products tagged active sell<br>";

//error_log(print_r(json_encode($response)),true);

//$return = json_encode($response);

//echo $return;

fgets(STDIN, 1024);

?>

    <script>

        alert("Product Job Done");

        // window.history.back();

    </script>

<?php

function get_percentage($total, $percentage){
    if ($total > 0){
        $number = $percentage / 100;
        $percentageOf = $total * $number;
        return $total + $percentageOf;
    }else{
        return 0;
    }
}





function kickout(){

    $target = "";

    $args = func_get_args();

    $format = array_shift($args);



    $output = "<pre>".$target."</pre>";

    echo $output;

}