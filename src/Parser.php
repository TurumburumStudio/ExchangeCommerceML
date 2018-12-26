<?php

namespace App;

class Parser
{
    public function load(string $xml)
    {
        if (is_file($xml)) {
            return simplexml_load_string(file_get_contents($xml));
        }

        return simplexml_load_string($xml);
    }
}