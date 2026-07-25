<?php

namespace Elemento\Elements;

use Elemento\Element;

class Iframe extends Element
{
    protected const TAG = 'iframe';

    /**
     * Create a iframe element.
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
     * @param string $name
     *
     * @return self
     */
    public function name(string $name): self
    {
        return $this->attr('name', $name);
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
     * @param string $value
     *
     * @return self
     */
    public function sandbox(string $value = ''): self
    {
        return $this->attr('sandbox', $value === '' ? true : $value);
    }
}
