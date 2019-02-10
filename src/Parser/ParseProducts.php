<?php

namespace ExchangeCommerceML\Parser;

class ParseProducts implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (!array_key_exists('Товары', $items['Каталог'])) {
            return $result;
        }

        foreach ($items['Каталог']['Товары']['Товар'] as $item) {
            $result[] = [
                'id' => $item['Ид'], 
                'article' => empty($item['Артикул']) ? '' : $item['Артикул'],
                'desc' => empty($item['Описание']) ? '' : $item['Описание'],
                'groups' => $this->getGroups($item['Группы']),
                'country' => empty($item['Страна']) ? '' : $item['Страна'],
                'weight' => empty($item['Вес']) ? '' : $item['Вес'],
                'inactive' => empty($item['ПометкаУдаления']) ? '' : $item['ПометкаУдаления'],
            ];
        }

        return $result;
    }

    private function getGroups(array $items): array
    {
        $result = [];

        if (!is_array($items['Ид'])) {
            return [
                ['id' => $items['Ид']]
            ];
        }

        foreach ($items['Ид'] as $item) {
            $result[] = ['id' => $item];
        }

        return $result;
    }
}