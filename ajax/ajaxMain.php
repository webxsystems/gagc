<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/28/2020
 * Time: 3:52 AM
 */
session_start();

include ('../GetProducts.php');
include ('../GetPrices.php');
include ('../GetImages.php');

$metalType = "Gold";

$GetProducts    = new GetProducts();
$GetPrices      = new GetPrices();
$GetImages      = new GetImages();

$goldProducts = json_decode($GetProducts->ByMetalType($metalType));
//echo "<pre>";
//print_r($goldProducts);
//echo "</pre>";

foreach($goldProducts as $goldProduct){
    $GetProducts->setName($goldProduct->name);
    $GetProducts->setCode($goldProduct->code);
    $GetProducts->setCategory($goldProduct->category);
    $GetProducts->setDescription($goldProduct->description);
    $GetProducts->setFineness($goldProduct->fineness);
    $GetProducts->setMetalType($goldProduct->metalType);
    $GetProducts->setWeight($goldProduct->weight);

    $goldPrice = json_decode($GetPrices->ByCode($GetProducts->getCode()));

    $GetPrices->setPriceTier1($goldPrice->{'tiers'}->{1}->{'ask'});
    $GetPrices->setPriceTier2($goldPrice->{'tiers'}->{2}->{'ask'});
    $GetPrices->setPriceTier3($goldPrice->{'tiers'}->{3}->{'ask'});
    $GetPrices->setPriceTier4($goldPrice->{'tiers'}->{4}->{'ask'});

    $goldImages = json_decode($GetImages->ByCode($GetProducts->getCode()));

    $GetImages->setImageURL($goldImages->imageURL);
    $GetImages->setImageSmallURL($goldImages->imageSmallURL);
    $GetImages->setImageLargeURL($goldImages->imageLargeURL);

    //print_r($goldPrice->{'tiers'}->{4}->{'bid'});
    echo "<pre>";
    //print_r($goldImages);
    //print_r($goldPrice->tiers);
    //print_r($GetPrices);
    //print_r($GetProducts);
    echo "</pre>";
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

/*echo "<pre>";
print_r($GetProducts);
echo "</pre>";*/

//echo "<table>";
//foreach($goldProducts as $goldProduct){
//    echo "<tr><td>".$goldProduct->name."</td><td>".$goldProduct->description."</td><td>".$goldProduct->code."</td></tr>";
//}
//echo "</table>";


