<?php

namespace ExchangeCommerceML\Loader;

use ExchangeCommerceML\Services;

class Loader
{
    private $types = [];
    private $data = [];
    private $type = '';

    public function __construct(string $xml)
    {
        if (!is_file($xml)) {
            throw new \Exception("File error");
        }

        if (stristr($xml, 'offers')) {
            $type = 'offers';
        } else if (stristr($xml, 'prices')) {
            $type = 'prices';
        } else if (stristr($xml, 'rests')) {
            $type = 'rests';
        } else {
            $type = 'import';
        }

        $file = file_get_contents($xml);

        $xml = simplexml_load_string($file);

        $types = Services\CheckType::getListType($this->XmlToArray($xml));

        $this->data = $this->XmlToArray($xml);
        $this->types = $types;
        $this->type = $type;
    }

    public function getArray(): array
    {
        if (in_array('Классификатор', $this->types)) {
            $loader = new LoadClassifier($this->data);
        } else if (in_array('Каталог', $this->types)) {
            $loader = new LoadCatalog($this->data);
        } elseif (in_array('ПакетПредложений', $this->types)) {
            $loader = new LoadOffers($this->data, $this->type);
        }

        return $loader->getData();
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTypes()
    {
        return $this->types;
    }

    private function XmlToArray(\SimpleXMLElement $xml): array
    {
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);

        return $array;
    }
}