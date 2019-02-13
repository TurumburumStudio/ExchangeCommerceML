<?php

namespace ExchangeCommerceML\Loader;

use ExchangeCommerceML\Services;

class Loader
{
    private $types = [];
    private $data = [];
    private $type = '';

    public function __construct(string $xmlPath)
    {
        if (!is_file($xmlPath)) {
            throw new \Exception("File error");
        }

        $file = file_get_contents($xmlPath);
        $xmlObj = simplexml_load_string($file);
        $types = Services\CheckType::getListType($this->XmlToArray($xmlObj));

        $type = '';

        if (stristr($xmlPath, 'offers')) {
            $type = 'offers';
        } else if (stristr($xmlPath, 'prices')) {
            $type = 'prices';
        } else if (stristr($xmlPath, 'rests')) {
            $type = 'rests';
        } else {
            if (in_array('Классификатор', $types)) {
                $type = 'classifier';
            } else if (in_array('Каталог', $types)) {
                $type = 'products';
            }
        }

        $this->data = $this->XmlToArray($xmlObj);
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

    private function XmlToArray(\SimpleXMLElement $xml): array
    {
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);

        return $array;
    }
}