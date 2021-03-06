<?php

namespace ExchangeCommerceML\Parser;

class ParsePrices implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];


        if (!(stripos(json_encode($items, JSON_UNESCAPED_UNICODE), 'Цены') > 0)) {
            return $result;
        }

        if (isset($items['ПакетПредложений']['Предложения']['Предложение']['Ид'])) {
            $result[] = [
                'id' => $items['ПакетПредложений']['Предложения']['Предложение']['Ид'],
                'prices' => $this->getPrices($items['ПакетПредложений']['Предложения']['Предложение']['Цены']['Цена'])
            ];
        } else {
            foreach ($items['ПакетПредложений']['Предложения']['Предложение'] as $item) {
                $result[] = [
                    'id' => $item['Ид'],
                    'prices' => $this->getPrices($item['Цены']['Цена'])
                ];
            }
        }

        return $result;
    }

    // TODO: create new class
    public function getTypePrices(array $items): array
    {
        $result = [];

        if (!(stripos(json_encode($items, JSON_UNESCAPED_UNICODE), 'ТипыЦен') > 0)) {
            return $result;
        }

        foreach ($items['Классификатор']['ТипыЦен']['ТипЦены'] as $item) {
            $result[] = [
                'id' => $item['Ид'], 
                'name' => $item['Наименование'],
                'inactive' => $item['ПометкаУдаления'], 
                'currency' => $item['Валюта']
            ];
        }

        return $result;
    }

    private function getPrices(array $items): array
    {
        $result = [];

        if (array_key_exists('ИдТипаЦены', $items)) {
            return [
                ['price_type_id' => $items['ИдТипаЦены'], 'price' => $items['ЦенаЗаЕдиницу'], 'currency' => $items['Валюта']]
            ];
        }

        foreach ($items as $item) {
            $result[] = ['price_type_id' => $item['ИдТипаЦены'], 'price' => $item['ЦенаЗаЕдиницу'], 'currency' => $item['Валюта']];
        }

        return $result;
    }
}