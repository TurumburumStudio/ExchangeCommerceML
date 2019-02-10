<?php

require_once('./vendor/autoload.php');

use ExchangeCommerceML\Loader\Loader;

$classifier_url = './storage/xml/import___2acfecc1-daa4-4e38-af6a-6734172b63cb.xml';
$import_url = './storage/xml/import___b5bef49f-0995-4899-841f-cc403c11e354.xml';
$offers_url = './storage/xml/offers___1f591eb2-8a7c-4b1b-8517-b529769dde3e.xml';
$prices_url = './storage/xml/prices___33dc972e-3062-4589-97e7-524a5bb6912c.xml';
$rests_url = './storage/xml/rests___3ba6364d-101f-42dc-a865-9977afd27253.xml';

$loadClassifier = new Loader($classifier_url);
$loadProducts = new Loader($import_url);
$loadOffers = new Loader($offers_url);
$loadPrices = new Loader($prices_url);
$loadRests = new Loader($rests_url);

//$classifier = $loadClassifier->getArray();
//$products = $loadProducts->getArray();
//$offers = $loadOffers->getArray();
//$prices = $loadPrices->getArray();
//$rests = $loadRests->getArray();

$loadRests->saveToJson();