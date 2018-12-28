<?php

require_once('./vendor/autoload.php');

use App\Loader\Loader;
use App\Parser\{ParseGroups, ParseProducts, ParseWarehouses};

$products_url = './storage/xml/products.xml';
$groups_url = './storage/xml/import.xml';

$loader = new Loader();
$productParser = new ParseProducts();
$groupParser = new ParseGroups();
$warehouseParser = new ParseWarehouses();

$product_xml = $loader->load($products_url);
$import_xml = $loader->load($groups_url);

$products = $productParser->getItems($product_xml);
$groups = $groupParser->getItems($import_xml);
$warehouses = $warehouseParser->getItems($import_xml);

dd($warehouses);
