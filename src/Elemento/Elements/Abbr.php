<?php

namespace Elemento\Elements;

use Elemento\Element;

class Abbr extends Element
{
    protected const TAG = 'abbr';

    /**
     * Create a abbr element with escaped text content.
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
