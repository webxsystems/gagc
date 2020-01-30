<?php
/**
 * Created by PhpStorm.
 * User: goldenboy
 * Date: 1/28/2020
 * Time: 3:52 AM
 */
session_start();

include('../GetProducts.php');

$GetProducts = new GetProducts();
$goldProducts = json_decode($GetProducts->ByMetalType("Gold"));

echo "<pre>";
print_r($goldProducts);
echo "</pre>";

echo "<table>";
foreach($goldProducts as $goldProduct){
    echo "<tr><td>".$goldProduct->name."</td><td>".$goldProduct->description."</td><td>".$goldProduct->code."</td></tr>";
}
echo "</table>";


