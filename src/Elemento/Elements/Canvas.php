<?php

namespace Elemento\Elements;

use Elemento\Element;

class Canvas extends Element
{
    protected const TAG = 'canvas';

    /**
     * Create a canvas element.
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
     * @param int $width
     *
     * @return self
     */
    public function width(int $width): self
    {
        return $this->attr('width', $width);
    }
    /**
     * Configure the element.
     *
     * @param int $height
     *
     * @return self
     */
    public function height(int $height): self
    {
        return $this->attr('height', $height);
    }
}
