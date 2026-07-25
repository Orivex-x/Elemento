<?php

namespace Elemento\Elements;

use Elemento\Element;

class Meter extends Element
{
    protected const TAG = 'meter';

    /**
     * Create a meter element.
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
     * @param float $value
     *
     * @return self
     */
    public function value(float $value): self
    {
        return $this->attr('value', $value);
    }
    /**
     * Configure the element.
     *
     * @param float $value
     *
     * @return self
     */
    public function min(float $value): self
    {
        return $this->attr('min', $value);
    }
    /**
     * Configure the element.
     *
     * @param float $value
     *
     * @return self
     */
    public function max(float $value): self
    {
        return $this->attr('max', $value);
    }
    /**
     * Configure the element.
     *
     * @param float $value
     *
     * @return self
     */
    public function low(float $value): self
    {
        return $this->attr('low', $value);
    }
    /**
     * Configure the element.
     *
     * @param float $value
     *
     * @return self
     */
    public function high(float $value): self
    {
        return $this->attr('high', $value);
    }
    /**
     * Configure the element.
     *
     * @param float $value
     *
     * @return self
     */
    public function optimum(float $value): self
    {
        return $this->attr('optimum', $value);
    }
}
