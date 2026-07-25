<?php

namespace Elemento\Elements;

use Elemento\Element;

class Figure extends Element
{
    protected const TAG = 'figure';

    /**
     * Create a figure element.
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
