<?php

namespace ExchangeCommerceML\Parser;

class ParsePrices implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (
            !array_key_exists('ПакетПредложений', $items) &&
            !array_key_exists('Предложения', $items['ПакетПредложений']) &&
            !array_key_exists('Предложение', $items['ПакетПредложений']['Предложения']) &&
            !array_key_exists('Цены', $items['ПакетПредложений']['Предложения']['Предложение'])
        ) {
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

        if (!array_key_exists('ТипыЦен', $items['Классификатор'])) {
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