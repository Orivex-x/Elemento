<?php

namespace Elemento\Elements;

use Elemento\Element;

class Li extends Element
{
    protected const TAG = 'li';

    /**
     * Create a li element with escaped text content.
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
     * @param int $value
     *
     * @return self
     */
    public function value(int $value): self
    {
        return $this->attr('value', $value);
    }
}
