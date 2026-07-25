<?php

namespace Elemento\Elements;

use Elemento\Element;

class Tr extends Element
{
    protected const TAG = 'tr';

    /**
     * Create a tr element.
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
