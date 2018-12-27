<?php

namespace App\Parser;

use App\Services\ArrayHelper;

class ParseGroups extends Parser implements ParserInterface
{
    use ArrayHelper;

    public function getItems(\SimpleXMLElement $xml): array
    {
        $items = $this->XmlToArray($xml);

        return $this->arrayFormatter($this->arrayFlatten($this->getGroups($items['Классификатор']['Группы']['Группа'])), 3);
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