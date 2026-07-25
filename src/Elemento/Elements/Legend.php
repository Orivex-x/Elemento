<?php

namespace Elemento\Elements;

use Elemento\Element;

class Legend extends Element
{
    /**
     * Create a new instance.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(string $text = '', array $attributes = [])
    {
        parent::__construct('legend', $attributes);

        if ($text !== '') {
            $this->text($text);
        }
    }

}
