<?php

namespace ExchangeCommerceML\Loader;

use Symfony\Component\Finder\Finder;

class Loader
{
    public function __construct()
    {
    }

    public function extractArray(string $path)
    {

    }

    public function load(string $xml)
    {
        if (is_file($xml)) {
            return simplexml_load_string(file_get_contents($xml));
        }

        return simplexml_load_string($xml);
    }
}