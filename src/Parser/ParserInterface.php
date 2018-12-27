<?php

namespace App\Parser;

interface ParserInterface
{
    function getItems(\SimpleXMLElement $xml): array;
}