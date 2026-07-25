<?php

namespace Elemento\Elements;

use Elemento\Element;

class Menu extends Element
{
    protected const TAG = 'menu';

    /**
     * Create a menu element.
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
