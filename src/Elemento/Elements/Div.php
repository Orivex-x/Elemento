<?php

namespace Elemento\Elements;

use Elemento\Element;

/**
 * A generic HTML div element.
 */
class Div extends Element
{
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct('div', $attributes);
    }
}
