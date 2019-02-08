<?php

namespace ExchangeCommerceML\Parser;

class ParseWarehouses extends Parser implements ParserInterface
{
    public function getItems(\SimpleXMLElement $xml): array
    {
        $items = $this->XmlToArray($xml);
        $result = [];

        foreach ($items['Классификатор']['Склады']['Склад'] as $item) {
            $result[] = [
                'id' => $item['Ид'], 
                'name' => $item['Наименование'], 
                'inactive' => $item['ПометкаУдаления']
            ];
        }

        return $result;
    }
}