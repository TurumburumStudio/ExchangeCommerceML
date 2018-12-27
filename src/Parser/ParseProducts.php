<?php

namespace App\Parser;

class ParseProducts extends Parser implements ParserInterface
{
    public function getItems(\SimpleXMLElement $xml): array
    {
        $items = $this->XmlToArray($xml);
        $result = [];

        foreach ($items['Каталог']['Товары']['Товар'] as $item) {
            $result[] = [
                'id' => $item['Ид'], 
                'article' => $item['Артикул'], 
                'desc' => $item['Описание'],
                'groups' => $this->getGroups($item['Группы']),
                'country' => $item['Страна'],
                'weight' => $item['Вес'],
                'is_active' => $item['ПометкаУдаления']
            ];

            //$result[] = $item;
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