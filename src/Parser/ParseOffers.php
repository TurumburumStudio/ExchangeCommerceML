<?php

namespace ExchangeCommerceML\Parser;

class ParseOffers implements ParserInterface
{
    public function getItems(array $items): array
    {
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