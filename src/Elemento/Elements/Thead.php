<?php

namespace Elemento\Elements;

use Elemento\Element;

class Thead extends Element
{
    protected const TAG = 'thead';

    /**
     * Create a thead element.
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
