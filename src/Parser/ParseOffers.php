<?php

namespace ExchangeCommerceML\Parser;

class ParseOffers implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (!(stripos(json_encode($items, JSON_UNESCAPED_UNICODE), 'Предложение') > 0)) {
            return $result;
        }

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