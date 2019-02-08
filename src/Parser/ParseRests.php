<?php

namespace ExchangeCommerceML\Parser;

class ParseRests implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (
            !array_key_exists('ПакетПредложений', $items) &&
            !array_key_exists('Предложения', $items['ПакетПредложений']) &&
            !array_key_exists('Предложение', $items['ПакетПредложений']['Предложения']) &&
            !array_key_exists('Остатки', $items['ПакетПредложений']['Предложения']['Предложение'])
        ) {
            return $result;
        }

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