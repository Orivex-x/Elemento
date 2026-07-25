<?php

namespace Elemento\Elements;

use Elemento\Element;

class Track extends Element
{
    protected const TAG = 'track';

    /**
     * Create a track element.
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
     * @param string $kind
     *
     * @return self
     */
    public function kind(string $kind): self
    {
        return $this->attr('kind', $kind);
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
     * @param string $language
     *
     * @return self
     */
    public function srclang(string $language): self
    {
        return $this->attr('srclang', $language);
    }
    /**
     * Configure the element.
     *
     * @param string $label
     *
     * @return self
     */
    public function label(string $label): self
    {
        return $this->attr('label', $label);
    }
    /**
     * Configure the element.
     *
     * @param bool $default
     *
     * @return self
     */
    public function default(bool $default = true): self
    {
        return $this->attr('default', $default);
    }
}
