<?php

namespace ExchangeCommerceML\Services;

trait ArrayHelper
{
    private function arrayFlatten(array $array): array
    { 
        $result = []; 

        foreach ($array as $key => $value) { 
          if (is_array($value)) { 
            $result = array_merge($result, $this->arrayFlatten($value)); 
          } else { 
            $result[$key] = $value; 
          } 
        }

        return $result; 
    }

    private function arrayFormatter(array $array, int $counter = 2): array
    {
        return array_chunk($array, $counter);
    }
}