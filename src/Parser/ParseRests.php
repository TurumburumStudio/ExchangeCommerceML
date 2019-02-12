<?php

namespace ExchangeCommerceML\Parser;

class ParseRests implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (!(stripos(json_encode($items, JSON_UNESCAPED_UNICODE), 'Остатки') > 0)) {
            return $result;
        }

        if (isset($items['ПакетПредложений']['Предложения']['Предложение']['Ид'])) {
            $result[] = [
                'id' => $items['ПакетПредложений']['Предложения']['Предложение']['Ид'],
                'warehouses' => $this->getRests($items['ПакетПредложений']['Предложения']['Предложение']['Остатки']['Остаток'])
            ];
        } else {
            foreach ($items['ПакетПредложений']['Предложения']['Предложение'] as $item) {
                $result[] = [
                    'id' => $item['Ид'],
                    'warehouses' => $this->getRests($item['Остатки']['Остаток'])
                ];
            }
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