<?php

namespace Elemento\Elements;

use Elemento\Element;

class ObjectElement extends Element
{
    protected const TAG = 'object';

    /**
     * Create a object element.
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
     * @param string $data
     *
     * @return self
     */
    public function resource(string $data): self
    {
        return $this->attr('data', $data);
    }
    /**
     * Configure the element.
     *
     * @param string $type
     *
     * @return self
     */
    public function type(string $type): self
    {
        return $this->attr('type', $type);
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
}
