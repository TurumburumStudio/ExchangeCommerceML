<?php

namespace ExchangeCommerceML\Parser;

class ParseRests implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        foreach ($items['ПакетПредложений']['Предложения']['Предложение'] as $item) {
            $result[] = [
                'id' => $item['Ид'], 
                'warehouses' => $this->getRests($item['Остатки']['Остаток'])
            ];
        }

        return $result;
    }

    private function getRests(array $items): array
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = ['id' => $item['Склад']['Ид'], 'count' => $item['Склад']['Количество']];
        }

        return $result;
    }
}