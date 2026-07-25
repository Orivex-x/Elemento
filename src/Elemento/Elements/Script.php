<?php

namespace Elemento\Elements;

use Elemento\Element;

class Script extends Element
{
    protected const TAG = 'script';

    /**
     * Create a script element.
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
     * @param bool $async
     *
     * @return self
     */
    public function async(bool $async = true): self
    {
        return $this->attr('async', $async);
    }
    /**
     * Configure the element.
     *
     * @param bool $defer
     *
     * @return self
     */
    public function defer(bool $defer = true): self
    {
        return $this->attr('defer', $defer);
    }
    /**
     * Configure the element.
     *
     * @param bool $enabled
     *
     * @return self
     */
    public function noModule(bool $enabled = true): self
    {
        return $this->attr('nomodule', $enabled);
    }
    /**
     * Configure the element.
     *
     * @param string $value
     *
     * @return self
     */
    public function integrity(string $value): self
    {
        return $this->attr('integrity', $value);
    }
}
