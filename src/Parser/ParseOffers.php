<?php

namespace App\Parser;

class ParseOffers extends Parser implements ParserInterface
{
    public function getItems(\SimpleXMLElement $xml): array
    {
        $items = $this->XmlToArray($xml);
        $result = [];

        foreach ($items['ПакетПредложений']['Предложения']['Предложение'] as $item) {
            $result[] = [
                'id' => $item['Ид'], 
                'name' => $item['Наименование'], 
                'inactive' => $item['ПометкаУдаления']
            ];
        }

        return $result;
    }
}