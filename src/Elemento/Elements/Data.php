<?php

namespace Elemento\Elements;

use Elemento\Element;

class Data extends Element
{
    protected const TAG = 'data';

    /**
     * Create a data element with escaped text content.
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

    /**
     * Configure the element.
     *
     * @param string $value
     *
     * @return self
     */
    public function value(string $value): self
    {
        return $this->attr('value', $value);
    }
}
