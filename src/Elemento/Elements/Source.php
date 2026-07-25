<?php

namespace Elemento\Elements;

use Elemento\Element;

class Source extends Element
{
    protected const TAG = 'source';

    /**
     * Create a source element.
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
     * @param string $media
     *
     * @return self
     */
    public function media(string $media): self
    {
        return $this->attr('media', $media);
    }
}
