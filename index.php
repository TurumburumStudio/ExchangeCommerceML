<?php

require_once('./vendor/autoload.php');

use App\Loader\Loader;
use App\Parser\{ParseGroups, ParseProducts, ParseWarehouses, ParseRests, ParsePrices, ParseOffers};

$classifier_url = './storage/xml/classifier.xml';
$import_url = './storage/xml/import.xml';
$offers_url = './storage/xml/offers.xml';
$rests_url = './storage/xml/rests.xml';
$prices_url = './storage/xml/prices.xml';

$loader = new Loader();
$groupParser = new ParseGroups();
$productParser = new ParseProducts();
$offerParser = new ParseOffers();
$warehouseParser = new ParseWarehouses();
$restParser = new ParseRests();
$priceParser = new ParsePrices();

$classifier_xml = $loader->load($classifier_url);
$import_xml = $loader->load($import_url);
$offers_xml = $loader->load($offers_url);
$rests_xml = $loader->load($rests_url);
$prices_xml = $loader->load($prices_url);

$groups = $groupParser->getItems($classifier_xml);
$products = $productParser->getItems($import_xml);
$offers = $offerParser->getItems($offers_xml);
$warehouses = $warehouseParser->getItems($classifier_xml);
$rests = $restParser->getItems($rests_xml);
$type_prices = $priceParser->getTypePrices($classifier_xml);
$prices = $priceParser->getItems($prices_xml);

dd($offers);
