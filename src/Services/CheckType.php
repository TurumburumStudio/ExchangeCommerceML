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
                $types[] = $type;
            }
        }

        return $types;
    }
}