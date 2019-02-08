<?php

namespace ExchangeCommerceML\Parser;

abstract class Parser
{
    protected function XmlToArray(\SimpleXMLElement $xml): array
    {
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);

        return $array;
    }
}