<?php

require_once('./vendor/autoload.php');

use App\Loader\Loader;
use App\Parser\{ParseGroups, ParseProducts, ParseWarehouses};

$import_url = './storage/xml/import.xml';
$classifier_url = './storage/xml/classifier.xml';

$loader = new Loader();
$productParser = new ParseProducts();
$groupParser = new ParseGroups();
$warehouseParser = new ParseWarehouses();

$import_xml = $loader->load($import_url);
$classifier_xml = $loader->load($classifier_url);

$products = $productParser->getItems($import_xml);
$groups = $groupParser->getItems($classifier_xml);
$warehouses = $warehouseParser->getItems($classifier_xml);

dd($warehouses);
