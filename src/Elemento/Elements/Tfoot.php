<?php

namespace Elemento\Elements;

use Elemento\Element;

class Tfoot extends Element
{
    protected const TAG = 'tfoot';

    /**
     * Create a tfoot element.
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
