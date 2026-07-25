<?php

namespace Elemento\Elements;

use Elemento\Element;

class Head extends Element
{
    protected const TAG = 'head';

    /**
     * Create a head element.
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
