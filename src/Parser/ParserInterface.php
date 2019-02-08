<?php

namespace ExchangeCommerceML\Parser;

interface ParserInterface
{
    function getItems(array $items): array;
}