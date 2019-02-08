<?php

namespace ExchangeCommerceML\Loader;

use ExchangeCommerceML\Parser\{ParseOffers, ParsePrices, ParseRests};

class LoadOffers implements LoadInterface
{
    private $type;
    private $data = [];

    public function __construct(array $data, string $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function getData(): array
    {
        $items = [];

        switch ($this->type) {
            case 'offers';
                $offersParser = new ParseOffers();
                if (!empty($offersParser->getItems($this->data))) {
                    $items['offers'] = $offersParser->getItems($this->data);
                }
                break;
            case 'prices';
                $pricesParser = new ParsePrices();
                if (!empty($pricesParser->getItems($this->data))) {
                    $items['prices'] = $pricesParser->getItems($this->data);
                }
                break;
            case 'rests';
                $restsParser = new ParseRests();
                if (!empty($restsParser->getItems($this->data))) {
                    $items['rests'] = $restsParser->getItems($this->data);
                }
                break;
        }

        return $items;
    }
}