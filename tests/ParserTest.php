<?php

namespace App\Tests;

use App\Loader\Loader;
use App\Parser\{ParseProducts, ParseGroups};

class ParserTest extends \PHPUnit\Framework\TestCase 
{
    public function testCategoriesCount()
    {
        $parser = new ParseGroups();
        $xml = $this->loadXml('./storage/import.xml');
        $groups = $parser->getItems($xml);
        $this->assertEquals(33, count($groups));
    }

    public function testProductsCount()
    {
        $parser = new ParseProducts();
        $xml = $this->loadXml('./storage/products.xml');
        $products = $parser->getItems($xml);
        $this->assertEquals(11, count($products));
    }

    private function loadXml(string $xml)
    {
        $loader = new Loader();
        return $loader->load($xml);
    }
}