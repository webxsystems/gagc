<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/29/2020
 * Time: 7:20 PM
 */

/*
Create a new product with the default product variant

POST /admin/api/2020-01/products.json

$product = array(
            "product"   =>
                array(
                        "title" => "1/2 GRAM GOLD BAR IGR",
                        "body_html" => "GOLD BARS ASSORTED WEIGHTS",
                        "vendor" => "PRIVATE MINT",
                        "product_type" => "Bullion Bars"
                )
);




            [isIRAConnectEligible] => N
            [origin] => PRIVATE MINT
            [name] => 1/2 GRAM GOLD BAR IGR
            [metalType] => Gold
            [code] => .5GRGBIGR
            [description] => GOLD BARS ASSORTED WEIGHTS
            [isActiveBuy] => Y
            [weight] => .5 g
            [meltFactor] => 0.01608
            [isActiveSell] => N
            [isSpecial] => N
            [category] => Bullion Bars
            [availability] => Not Available
            [isIRAEligible] => N
            [fineness] => .9999 FINE GOLD
            [isFractional] => N
            [isRSPConnectEligible] => N
        )
*/

class createProducts
{

private $api;
private $returnJSON;
private $devServerURL;
private $path;
private $method;
private $url;
private $c;
private $fullpath;


function __construct()
{
    $this->api = "4103-906cd5f5ebddd4dab583e9a5ec0e414d/";
    $this->devServerURL = "https://stage-connect.fiztrade.com/";
    $this->path = "FizServices/";
}

public function createProduct()
{
    $productinfo   =  array(
                "title" => "1/2 GRAM GOLD BAR IGR",
                "body_html" => "GOLD BARS ASSORTED WEIGHTS",
                "vendor" => "PRIVATE MINT"
    );
    //Create a new product

    $products = $shopify->Product->post($productInfo);
}
/*
"product": {
    "id": 1071559582,
    "title": "Burton Custom Freestyle 151",
    "body_html": "<strong>Good snowboard!</strong>",
    "vendor": "Burton",
    "product_type": "Snowboard",
    "created_at": "2020-01-14T10:33:32-05:00",
    "handle": "burton-custom-freestyle-151",
    "updated_at": "2020-01-14T10:33:32-05:00",
    "published_at": "2020-01-14T10:33:32-05:00",
    "template_suffix": null,
    "published_scope": "web",
    "tags": "\"Big Air\", Barnes & Noble, John's Fav",
    "admin_graphql_api_id": "gid://shopify/Product/1071559582",
    "variants": [
      {
          "id": 1070325028,
        "product_id": 1071559582,
        "title": "Default Title",
        "price": "0.00",
        "sku": "",
        "position": 1,
        "inventory_policy": "deny",
        "compare_at_price": null,
        "fulfillment_service": "manual",
        "inventory_management": null,
        "option1": "Default Title",
        "option2": null,
        "option3": null,
        "created_at": "2020-01-14T10:33:32-05:00",
        "updated_at": "2020-01-14T10:33:32-05:00",
        "taxable": true,
        "barcode": null,
        "grams": 0,
        "image_id": null,
        "weight": 0.0,
        "weight_unit": "lb",
        "inventory_item_id": 1070325030,
        "inventory_quantity": 0,
        "old_inventory_quantity": 0,
        "requires_shipping": true,
        "admin_graphql_api_id": "gid://shopify/ProductVariant/1070325028",
        "presentment_prices": [
          {
              "price": {
              "currency_code": "USD",
              "amount": "0.00"
            },
            "compare_at_price": null
          }
        ]
      }
    ],
    "options": [
      {
          "id": 1022828619,
        "product_id": 1071559582,
        "name": "Title",
        "position": 1,
        "values": [
          "Default Title"
      ]
      }
    ],
    "images": [],
    "image": null
  }
}
*/