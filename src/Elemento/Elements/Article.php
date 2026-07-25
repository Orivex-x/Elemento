<?php

namespace Elemento\Elements;

use Elemento\Element;

class Article extends Element
{
    protected const TAG = 'article';

    /**
     * Create a article element.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct(static::TAG, $attributes);
    }
}
