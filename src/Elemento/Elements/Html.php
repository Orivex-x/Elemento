<?php

namespace Elemento\Elements;

use Elemento\Element;

class Html extends Element
{
    protected const TAG = 'html';

    /**
     * Create a html element.
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
