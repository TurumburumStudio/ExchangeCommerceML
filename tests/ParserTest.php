<?php

namespace App\Tests;

use App\Loader\Loader;
use App\Parser\ParseGroups;

class ParserTest extends \PHPUnit\Framework\TestCase 
{
    public function testCategoryCount()
    {
        $loader = new Loader();
        $parser = new ParseGroups();
        
        $xml = $loader->load('./storage/import.xml');
        
        $groups = $parser->getItems($xml);

        $this->assertEquals(33, count($groups));
    }
}