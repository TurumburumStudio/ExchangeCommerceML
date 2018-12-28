<?php

namespace App\Tests\Parser;

use App\Loader\Loader;
use App\Parser\{ParseProducts, ParseGroups, ParseWarehouses, ParseRests, ParsePrices};

class ParserCountTest extends \PHPUnit\Framework\TestCase 
{
    public function testCategoriesCount(): void
    {
        $parser = new ParseGroups();
        $xml = $this->loadXml('./storage/xml/classifier.xml');
        $groups = $parser->getItems($xml);
        $this->assertEquals(2, count($groups));
    }

    public function testProductsCount(): void
    {
        $parser = new ParseProducts();
        $xml = $this->loadXml('./storage/xml/import.xml');
        $products = $parser->getItems($xml);
        $this->assertEquals(11, count($products));
    }

    public function testWarehousesCount(): void
    {
        $parser = new ParseWarehouses();
        $xml = $this->loadXml('./storage/xml/classifier.xml');
        $warehouses = $parser->getItems($xml);
        $this->assertEquals(14, count($warehouses));
    }

    public function testRestsCount(): void
    {
        $parser = new ParseRests();
        $xml = $this->loadXml('./storage/xml/rests.xml');
        $rests = $parser->getItems($xml);
        $this->assertEquals(12, count($rests));
    }

    public function testPricesCount(): void
    {
        $parser = new ParsePrices();
        $xml = $this->loadXml('./storage/xml/prices.xml');
        $prices = $parser->getItems($xml);
        $this->assertEquals(3, count($prices));
    }

    public function testTypePricesCount(): void
    {
        $parser = new ParsePrices();
        $xml = $this->loadXml('./storage/xml/classifier.xml');
        $type_prices = $parser->getTypePrices($xml);
        $this->assertEquals(7, count($type_prices));
    }

    private function loadXml(string $xml): \SimpleXMLElement
    {
        $loader = new Loader();
        return $loader->load($xml);
    }
} 