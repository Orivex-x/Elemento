<?php

namespace Elemento\Elements;

use Elemento\Element;

class Hr extends Element
{
    protected const TAG = 'hr';

    /**
     * Create a hr element.
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
