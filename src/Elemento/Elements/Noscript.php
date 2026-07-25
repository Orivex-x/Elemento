<?php

namespace Elemento\Elements;

use Elemento\Element;

class Noscript extends Element
{
    protected const TAG = 'noscript';

    /**
     * Create a noscript element.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct(static::TAG, $attributes);
    }
}
