<?php

namespace ExchangeCommerceML\Loader;

use ExchangeCommerceML\Parser\ParseProducts;

class LoadCatalog implements LoadInterface
{
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        $items = [];

        $productParser = new ParseProducts();
        if (!empty($productParser->getItems($this->data))) {
            $items = $productParser->getItems($this->data);
        }

        return $items;
    }
}