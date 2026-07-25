<?php

namespace Elemento\Elements;

use Elemento\Element;

class Col extends Element
{
    protected const TAG = 'col';

    /**
     * Create a col element.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct(static::TAG, $attributes);
    }
    /**
     * Configure the element.
     *
     * @param int $span
     *
     * @return self
     */
    public function span(int $span): self
    {
        return $this->attr('span', $span);
    }
}
