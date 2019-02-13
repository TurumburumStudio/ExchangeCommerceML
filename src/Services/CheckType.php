<?php

namespace ExchangeCommerceML\Services;

class CheckType
{
    static private $listType = [
        'Классификатор',
        'Каталог',
        'ПакетПредложений'
    ];

    static function getListType(array $items): array
    {
        $types = [];

        foreach (self::$listType as $type) {
            if (array_key_exists($type, $items)) {
                if ($type == 'Каталог' && !array_key_exists('Товары', $items['Каталог'])) continue;
                $types[] = $type;
            }
        }

        return $types;
    }
}