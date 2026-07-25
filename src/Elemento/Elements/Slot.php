<?php

namespace Elemento\Elements;

use Elemento\Element;

class Slot extends Element
{
    protected const TAG = 'slot';

    /**
     * Create a slot element.
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
