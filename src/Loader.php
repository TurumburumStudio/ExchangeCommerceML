<?php

namespace App;

use Symfony\Component\Finder\Finder;

class Loader
{
    private $finder;
    private $config;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    public function extractArray(string $path)
    {

    }
}