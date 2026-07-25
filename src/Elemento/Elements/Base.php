<?php

namespace Elemento\Elements;

use Elemento\Element;

class Base extends Element
{
    protected const TAG = 'base';

    /**
     * Create a base element.
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
     * @param string $href
     *
     * @return self
     */
    public function href(string $href): self
    {
        return $this->attr('href', $href);
    }
    /**
     * Configure the element.
     *
     * @param string $target
     *
     * @return self
     */
    public function target(string $target): self
    {
        return $this->attr('target', $target);
    }
}
