<?php

namespace Elemento\Elements;

use Elemento\Element;

class Code extends Element
{
    protected const TAG = 'code';

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
        parent::__construct(static::TAG, $attributes);

        if ($text !== '') {
            $this->text($text);
        }
    }
}
