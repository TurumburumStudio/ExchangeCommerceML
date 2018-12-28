<?php

require_once('./vendor/autoload.php');

use App\Loader\Loader;
use App\Parser\{ParseGroups, ParseProducts, ParseWarehouses, ParseRests, ParsePrices};

$classifier_url = './storage/xml/classifier.xml';
$import_url = './storage/xml/import.xml';
$rests_url = './storage/xml/rests.xml';
$prices_url = './storage/xml/prices.xml';

$loader = new Loader();
$productParser = new ParseProducts();
$groupParser = new ParseGroups();
$warehouseParser = new ParseWarehouses();
$restParser = new ParseRests();
$priceParser = new ParsePrices();

$import_xml = $loader->load($import_url);
$classifier_xml = $loader->load($classifier_url);
$rests_xml = $loader->load($rests_url);
$prices_xml = $loader->load($prices_url);

$products = $productParser->getItems($import_xml);
$groups = $groupParser->getItems($classifier_xml);
$warehouses = $warehouseParser->getItems($classifier_xml);
$rests = $restParser->getItems($rests_xml);
$type_prices = $priceParser->getTypePrices($classifier_xml);
$prices = $priceParser->getItems($prices_xml);

dd($prices);
