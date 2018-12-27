<?php

require_once('./vendor/autoload.php');

use App\Loader\Loader;
use App\Parser\ParseGroups;

$url = './storage/import.xml';

$loader = new Loader();
$parser = new ParseGroups();

$xml = $loader->load($url);

$groups = $parser->getItems($xml);

dd(count($groups));
