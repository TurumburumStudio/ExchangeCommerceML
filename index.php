<?php

require_once('./vendor/autoload.php');

use App\Loader\Loader;
use App\Parser\{ParseGroups, ParseProducts, ParseWarehouses, ParseRests, ParsePrices, ParseOffers};

$classifier_url = './storage/xml/import___2acfecc1-daa4-4e38-af6a-6734172b63cb.xml';
$import_url = './storage/xml/import___b5bef49f-0995-4899-841f-cc403c11e354.xml';
$offers_url = './storage/xml/offers___1f591eb2-8a7c-4b1b-8517-b529769dde3e.xml';
$rests_url = './storage/xml/rests___3ba6364d-101f-42dc-a865-9977afd27253.xml';
$prices_url = './storage/xml/prices___33dc972e-3062-4589-97e7-524a5bb6912c.xml';

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
$warehouses = $warehouseParser->getItems($classifier_xml);
$type_prices = $priceParser->getTypePrices($classifier_xml);

$products = $productParser->getItems($import_xml);

$offers = $offerParser->getItems($offers_xml);

$rests = $restParser->getItems($rests_xml);

$prices = $priceParser->getItems($prices_xml);
