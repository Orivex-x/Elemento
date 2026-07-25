<?php

namespace Elemento\Elements;

use Elemento\Element;

class Nav extends Element
{
    protected const TAG = 'nav';

    /**
     * Create a nav element.
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
