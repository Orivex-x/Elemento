<?php

namespace Elemento\Elements;

use Elemento\Element;

class Blockquote extends Element
{
    protected const TAG = 'blockquote';

    /**
     * Create a blockquote element with escaped text content.
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
     * @param string $url
     *
     * @return self
     */
    public function cite(string $url): self
    {
        return $this->attr('cite', $url);
    }
}
