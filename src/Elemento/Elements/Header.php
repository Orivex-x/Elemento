<?php

namespace Elemento\Elements;

use Elemento\Element;

class Header extends Element
{
    protected const TAG = 'header';

    /**
     * Create a header element with escaped text content.
     *
     * @param string $text
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(string $text = '', array $attributes = [])
    {
        parent::__construct(static::TAG, $attributes);

        if ($text !== '') {
            $this->text($text);
        }
    }
}
