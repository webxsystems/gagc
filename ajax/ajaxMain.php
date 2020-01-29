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
$_SESSION['data'] = print_r($goldProducts);
echo $goldProducts;

