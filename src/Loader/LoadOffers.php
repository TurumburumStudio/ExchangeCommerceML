<?php

namespace ExchangeCommerceML\Loader;

class LoadOffers implements LoadInterface
{
    private $type;
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->type = 'test';
    }

    public function getData(): array
    {
        $items = [];

        switch ($this->type) {
            case 'offers';
                echo "offers";
                break;
            case 'prices';
                echo "prices";
                break;
            case 'rests';
                echo "rests";
                break;
        }

        return $items;
    }
}