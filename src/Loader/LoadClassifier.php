<?php

namespace ExchangeCommerceML\Loader;

use ExchangeCommerceML\Parser\{ParseGroups, ParseProducts, ParseWarehouses, ParsePrices};

class LoadClassifier implements LoadInterface
{
    private $data = [];
    private $listType = [
        'Группы',
        'ТипыЦен',
        'Склады',
        'Товары',
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
                case 'Товары';
                    $productParser = new ParseProducts();
                    if (!empty($productParser->getItems($this->data))) {
                        $items['products'] = $productParser->getItems($this->data);
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