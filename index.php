<?php

require_once('./vendor/autoload.php');

use App\Loader\Loader;
use App\Parser\{ParseGroups, ParseProducts};

$products_url = './storage/products.xml';
$groups_url = './storage/import.xml';

$loader = new Loader();
$productParser = new ParseProducts();
$groupParser = new ParseGroups();


$product_xml = $loader->load($products_url);
$group_xml = $loader->load($groups_url);

$products = $productParser->getItems($product_xml);
$groups = $groupParser->getItems($group_xml);

dd($products);
