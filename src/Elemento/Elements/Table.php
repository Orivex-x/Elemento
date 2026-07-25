<?php

namespace Elemento\Elements;

use Elemento\Element;

class Table extends Element
{
    protected const TAG = 'table';

    /**
     * Create a table element.
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
