<?php

namespace App\Parser;

use App\Services\ArrayHelper;

class ParseGroups extends Parser implements ParserInterface
{
    use ArrayHelper;

    public function getItems(\SimpleXMLElement $xml): array
    {
        $items = $this->XmlToArray($xml);

        $groups = $this->getGroups($items['Классификатор']['Группы']['Группа']);

        return array_map(function ($item) {
            return ['id' => $item[0], 'name' => $item[1], 'parent' => $item[2]];
        }, $this->arrayFormatter($this->arrayFlatten($groups), 3));
    }

    private function getGroups(array $items, string $parent = null): array
    {
        foreach ($items as $item) {
            $groups[] = [$item['Ид'], $item['Наименование'], $parent];

            if (array_key_exists('Группы', $item)) {
                $groups[] = $this->getGroups($item['Группы']['Группа'], $item['Ид']);
            }
        }

        return $groups;
    }
}