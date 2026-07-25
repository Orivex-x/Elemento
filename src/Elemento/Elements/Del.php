<?php

namespace Elemento\Elements;

use Elemento\Element;

class Del extends Element
{
    protected const TAG = 'del';

    /**
     * Create a del element with escaped text content.
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
    /**
     * Configure the element.
     *
     * @param string $dateTime
     *
     * @return self
     */
    public function dateTime(string $dateTime): self
    {
        return $this->attr('datetime', $dateTime);
    }
}
