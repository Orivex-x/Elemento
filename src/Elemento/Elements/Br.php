<?php

namespace Elemento\Elements;

use Elemento\Element;

class Br extends Element
{
    protected const TAG = 'br';

    /**
     * Create a br element.
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
