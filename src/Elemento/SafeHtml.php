<?php

namespace Elemento;

use Stringable;

/**
 * Explicitly marks a fragment as trusted HTML.
 */
final readonly class SafeHtml implements Stringable
{
    private string $html;

    /**
     * @param string $html
     */
    public function __construct(string $html)
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->html;
    }
}
