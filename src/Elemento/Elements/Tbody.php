<?php

namespace Elemento\Elements;

use Elemento\Element;

class Tbody extends Element
{
    protected const TAG = 'tbody';

    /**
     * Create a tbody element.
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
