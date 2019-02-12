<?php

namespace ExchangeCommerceML\Loader;

use ExchangeCommerceML\Parser\{ParseGroups, ParseWarehouses, ParsePrices};

class LoadClassifier implements LoadInterface
{
    private $data = [];
    private $listType = [
        'Группы',
        'ТипыЦен',
        'Склады',
        //'Свойства',
        //'ЕдиницыИзмерения',
    ];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        $items = [];

        foreach ($this->listType as $type) {
            switch ($type) {
                case 'Группы';
                    $groupParser = new ParseGroups();
                    if (!empty($groupParser->getItems($this->data))) {
                        $items['groups'] = $groupParser->getItems($this->data);
                    }
                    break;
                case 'ТипыЦен';
                    $priceParser = new ParsePrices();
                    if (!empty($priceParser->getTypePrices($this->data))) {
                        $items['price_type'] = $priceParser->getTypePrices($this->data);
                    }
                    break;
                case 'Склады';
                    $warehouseParser = new ParseWarehouses();
                    if (!empty($warehouseParser->getItems($this->data))) {
                        $items['warehouses'] = $warehouseParser->getItems($this->data);
                    }
                    break;
            }
        }

        return $items;
    }
}