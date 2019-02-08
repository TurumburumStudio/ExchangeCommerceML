<?php

namespace ExchangeCommerceML\Parser;

interface ParserInterface
{
    function getItems(\SimpleXMLElement $xml): array;
}