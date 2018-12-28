<?php

namespace App\Tests;

use App\Loader\Loader;
use App\Parser\{ParseProducts, ParseGroups, ParseWarehouses};

class ParserTest extends \PHPUnit\Framework\TestCase 
{
    public function testCategoriesCount(): void
    {
        $parser = new ParseGroups();
        $xml = $this->loadXml('./storage/xml/import.xml');
        $groups = $parser->getItems($xml);
        $this->assertEquals(33, count($groups));
    }

    public function testProductsCount(): void
    {
        $parser = new ParseProducts();
        $xml = $this->loadXml('./storage/xml/products.xml');
        $products = $parser->getItems($xml);
        $this->assertEquals(11, count($products));
    }

    public function testWarehousesCount(): void
    {
        $parser = new ParseWarehouses();
        $xml = $this->loadXml('./storage/xml/import.xml');
        $warehouses = $parser->getItems($xml);
        $this->assertEquals(6, count($warehouses));
    }

    private function loadXml(string $xml)
    {
        $loader = new Loader();
        return $loader->load($xml);
    }
}