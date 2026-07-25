<?php

namespace Elemento\Elements;

use Elemento\Element;

class Colgroup extends Element
{
    protected const TAG = 'colgroup';

    /**
     * Create a colgroup element.
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
