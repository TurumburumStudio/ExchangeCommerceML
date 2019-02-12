<?php

namespace ExchangeCommerceML\Parser;

class ParseWarehouses implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (!(stripos(json_encode($items, JSON_UNESCAPED_UNICODE), 'Склады') > 0)) {
            return $result;
        }

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