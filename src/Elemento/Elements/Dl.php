<?php

namespace Elemento\Elements;

use Elemento\Element;

class Dl extends Element
{
    protected const TAG = 'dl';

    /**
     * Create a dl element.
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
