<?php

namespace Elemento\Elements;

use Elemento\Element;

class Dt extends Element
{
    protected const TAG = 'dt';

    /**
     * Create a dt element.
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
