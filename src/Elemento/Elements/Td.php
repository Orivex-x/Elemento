<?php

namespace Elemento\Elements;

use Elemento\Element;

class Td extends Element
{
    protected const TAG = 'td';

    /**
     * Create a td element with escaped text content.
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
     * @param int $span
     *
     * @return self
     */
    public function colspan(int $span): self
    {
        return $this->attr('colspan', $span);
    }
    /**
     * Configure the element.
     *
     * @param int $span
     *
     * @return self
     */
    public function rowspan(int $span): self
    {
        return $this->attr('rowspan', $span);
    }
    /**
     * Configure the element.
     *
     * @param string $ids
     *
     * @return self
     */
    public function headers(string $ids): self
    {
        return $this->attr('headers', $ids);
    }
}
