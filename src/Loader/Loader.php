<?php

namespace ExchangeCommerceML\Loader;

use ExchangeCommerceML\Services;

class Loader
{
    private $types = [];
    private $data = [];

    public function __construct(string $xml)
    {
        if (!is_file($xml)) {
            throw new \Exception("File error");
        }

        $file = file_get_contents($xml);

        $xml = simplexml_load_string($file);

        $types = Services\CheckType::getListType($this->XmlToArray($xml));

        $this->data = $this->XmlToArray($xml);
        $this->types = $types;
    }

    public function getArray(): array
    {
        if (in_array('Классификатор', $this->types) || in_array('Каталог', $this->types)) {
            $loader = new LoadClassifier($this->data);
        } elseif (in_array('ПакетПредложений', $this->types)) {
            $loader = new LoadOffers($this->data);
        }

        return $loader->getData();
    }

    private function XmlToArray(\SimpleXMLElement $xml): array
    {
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);

        return $array;
    }
}