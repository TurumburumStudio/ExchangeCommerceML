<?php

require_once('./vendor/autoload.php');

use App\Loader\Loader;
use App\Parser\{ParseGroups, ParseProducts, ParseWarehouses, ParseRests};

$classifier_url = './storage/xml/classifier.xml';
$import_url = './storage/xml/import.xml';
$rests_url = './storage/xml/rests.xml';

$loader = new Loader();
$productParser = new ParseProducts();
$groupParser = new ParseGroups();
$warehouseParser = new ParseWarehouses();
$restParser = new ParseRests();

$import_xml = $loader->load($import_url);
$classifier_xml = $loader->load($classifier_url);
$rests_xml = $loader->load($rests_url);

$products = $productParser->getItems($import_xml);
$groups = $groupParser->getItems($classifier_xml);
$warehouses = $warehouseParser->getItems($classifier_xml);
$rests = $restParser->getItems($rests_xml);

dd($rests);
