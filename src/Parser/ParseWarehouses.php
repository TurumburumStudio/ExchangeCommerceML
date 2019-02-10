<?php

namespace ExchangeCommerceML\Parser;

class ParseWarehouses implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (!array_key_exists('Склады', $items['Классификатор'])) {
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