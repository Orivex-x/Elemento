<?php

namespace Elemento\Elements;

use Elemento\Element;

class Area extends Element
{
    protected const TAG = 'area';

    /**
     * Create a area element.
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
     * @param string $text
     *
     * @return self
     */
    public function alt(string $text): self
    {
        return $this->attr('alt', $text);
    }
    /**
     * Configure the element.
     *
     * @param string $coordinates
     *
     * @return self
     */
    public function coords(string $coordinates): self
    {
        return $this->attr('coords', $coordinates);
    }
    /**
     * Configure the element.
     *
     * @param string $shape
     *
     * @return self
     */
    public function shape(string $shape): self
    {
        return $this->attr('shape', $shape);
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
