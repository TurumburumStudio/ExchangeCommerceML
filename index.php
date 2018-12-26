<?php

require_once('./vendor/autoload.php');

use App\FinderCommerceML;
use Symfony\Component\Finder\Finder;

$config = require_once('./config/app.php');

$finder = new FinderCommerceML(new Finder());

//$finder = new FinderCommerceML($config);