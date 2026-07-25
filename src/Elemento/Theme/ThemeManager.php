<?php

namespace Elemento\Theme;

use Elemento\Element;

class ThemeManager
{
    private static ?ThemeInterface $currentTheme = null;

    /**
     * Set the theme
     *
     * @param ThemeInterface $theme
     * @return void
     */
    public static function setTheme(ThemeInterface $theme): void
    {
        self::$currentTheme = $theme;
    }

    /**
     * Get the current theme
     *
     * @return ThemeInterface
     */
    public static function getTheme(): ThemeInterface
    {
        if (self::$currentTheme === null) {
            self::$currentTheme = new BootstrapTheme();
        }

        return self::$currentTheme;
    }

    /**
     * Get the theme name
     *
     * @return string
     */
    public static function getThemeName(): string
    {
        return self::getTheme()->getName();
    }

    /**
     * Create a button using the current theme
     *
     * @param string $text
     * @param string $type
     * @return Element
     */
    public static function button(string $text, string $type = 'primary'): Element
    {
        return self::getTheme()->button($text, $type);
    }

    /**
     * Create a card using the current theme
     *
     * @param string $title
     * @param string $content
     * @return Element
     */
    public static function card(string $title, string $content): Element
    {
        return self::getTheme()->card($title, $content);
    }

    /**
     * Create an alert using the current theme
     *
     * @param string $message
     * @param string $type
     * @return Element
     */
    public static function alert(string $message, string $type = 'info'): Element
    {
        return self::getTheme()->alert($message, $type);
    }

    /**
     * Create a badge using the current theme
     *
     * @param string $text
     * @param string $type
     * @return Element
     */
    public static function badge(string $text, string $type = 'primary'): Element
    {
        return self::getTheme()->badge($text, $type);
    }

    /**
     * Reset to the default theme (Bootstrap)
     *
     * @return void
     */
    public static function reset(): void
    {
        self::$currentTheme = new BootstrapTheme();
    }
}
