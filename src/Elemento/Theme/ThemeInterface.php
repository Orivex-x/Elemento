<?php

namespace Elemento\Theme;

use Elemento\Element;

interface ThemeInterface
{
    /**
     * Style a button element
     *
     * @param string $text
     * @param string $type
     * @return Element
     */
    public function button(string $text, string $type = 'primary'): Element;

    /**
     * Style a card
     *
     * @param string $title
     * @param string $content
     * @return Element
     */
    public function card(string $title, string $content): Element;

    /**
     * Style an alert
     *
     * @param string $message
     * @param string $type
     * @return Element
     */
    public function alert(string $message, string $type = 'info'): Element;

    /**
     * Style a badge
     *
     * @param string $text
     * @param string $type
     * @return Element
     */
    public function badge(string $text, string $type = 'primary'): Element;

    /**
     * Get the theme name
     *
     * @return string
     */
    public function getName(): string;
}
