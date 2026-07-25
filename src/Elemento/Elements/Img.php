<?php

namespace Elemento\Elements;

use Elemento\Element;

class Img extends Element
{
    protected const TAG = 'img';

    /**
     * Create a img element.
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
     * @param string $src
     *
     * @return self
     */
    public function src(string $src): self
    {
        return $this->attr('src', $src);
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
    /**
     * Configure the element.
     *
     * @param string $value
     *
     * @return self
     */
    public function loading(string $value): self
    {
        return $this->attr('loading', $value);
    }
    /**
     * Configure the element.
     *
     * @param string $sources
     *
     * @return self
     */
    public function srcset(string $sources): self
    {
        return $this->attr('srcset', $sources);
    }
    /**
     * Configure the element.
     *
     * @param string $sizes
     *
     * @return self
     */
    public function sizes(string $sizes): self
    {
        return $this->attr('sizes', $sizes);
    }
}
