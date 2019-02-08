<?php

namespace ExchangeCommerceML\Parser;

class ParseOffers implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (
            !array_key_exists('ПакетПредложений', $items) &&
            !array_key_exists('Предложения', $items['ПакетПредложений']) &&
            !array_key_exists('Предложение', $items['ПакетПредложений']['Предложения'])
        ) {
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