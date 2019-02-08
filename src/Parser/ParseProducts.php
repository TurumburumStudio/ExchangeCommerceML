<?php

namespace ExchangeCommerceML\Parser;

class ParseProducts implements ParserInterface
{
    public function getItems(array $items): array
    {
        $result = [];

        if (!array_key_exists('Товары', $items)) {
            return $result;
        }

        foreach ($items['Каталог']['Товары']['Товар'] as $item) {
            $result[] = [
                'id' => $item['Ид'], 
                'article' => $item['Артикул'], 
                'desc' => $item['Описание'],
                'groups' => $this->getGroups($item['Группы']),
                'country' => $item['Страна'],
                'weight' => $item['Вес'],
                'inactive' => $item['ПометкаУдаления']
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