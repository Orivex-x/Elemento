<?php

namespace Elemento\Elements;

use Elemento\Element;

class Details extends Element
{
    protected const TAG = 'details';

    /**
     * Create a details element.
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
     * @param bool $open
     *
     * @return self
     */
    public function open(bool $open = true): self
    {
        return $this->attr('open', $open);
    }
    /**
     * Configure the element.
     *
     * @param string $name
     *
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
    }
}
