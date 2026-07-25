<?php

namespace Elemento\Elements;

use Elemento\Element;

class Body extends Element
{
    protected const TAG = 'body';

    /**
     * Create a body element.
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
