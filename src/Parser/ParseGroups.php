<?php

namespace ExchangeCommerceML\Parser;

use ExchangeCommerceML\Services\ArrayHelper;

class ParseGroups implements ParserInterface
{
    use ArrayHelper;

    public function getItems(array $items): array
    {

        if (
            !array_key_exists('Классификатор', $items) &&
            !array_key_exists('Группы', $items['Классификатор'])
        ) {
            return [];
        }

        return $items['Классификатор']['Группы'];

//        $groups = $this->getGroups($items['Классификатор']['Группы']['Группа']);

//        return array_map(function ($item) {
//            return ['id' => $item[0], 'name' => $item[1], 'parent' => $item[2]];
//        }, $this->arrayFormatter($this->arrayFlatten($groups), 3));
    }

    private function getGroups(array $items, string $parent = null): array
    {
        if (isset($items['Ид'])) {
            $groups[] = [$items['Ид'], $items['Наименование'], $parent];

            if (array_key_exists('Группы', $items)) {
                $groups[] = $this->getGroups($items['Группы']['Группа'], $items['Ид']);
            }
        } else {
            foreach ($items as $item) {
                $groups[] = [$item['Ид'], $item['Наименование'], $parent];

                if (array_key_exists('Группы', $item)) {
                    $groups[] = $this->getGroups($item['Группы']['Группа'], $item['Ид']);
                }
            }
        }

        return $groups;
    }
}