<?php

namespace Elemento\Elements;

use Elemento\Element;

class Time extends Element
{
    protected const TAG = 'time';

    /**
     * Create a time element with escaped text content.
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
     * @param string $dateTime
     *
     * @return self
     */
    public function dateTime(string $dateTime): self
    {
        return $this->attr('datetime', $dateTime);
    }
}
