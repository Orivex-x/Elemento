<?php

namespace Elemento\Exceptions;

use Exception;

class ElementoException extends Exception
{
    /**
     * Create an exception for an invalid HTML tag
     *
     * @param string $tag
     * @return self
     */
    public static function invalidTag(string $tag): self
    {
        return new self("Invalid HTML tag: '$tag'.");
    }

    /**
     * Create an exception for a missing field in a form
     *
     * @param string $name
     * @return self
     */
    public static function missingField(string $name): self
    {
        return new self("Field name '$name' not found in form.");
    }

    /**
     * Create an exception for a missing macro
     *
     * @param string $name
     * @return self
     */
    public static function macroNotFound(string $name): self
    {
        return new self("Macro '$name' not found.");
    }

    /**
     * Create an exception for an invalid theme
     *
     * @param string $class
     * @return self
     */
    public static function invalidTheme(string $class): self
    {
        return new self("Invalid theme: '$class' does not implement ThemeInterface.");
    }

    /**
     * Create an exception for CSRF token verification failure
     *
     * @return self
     */
    public static function csrfVerificationFailed(): self
    {
        return new self("CSRF token verification failed.");
    }

    /**
     * Create an exception for invalid form data
     *
     * @param string $message
     * @return self
     */
    public static function invalidFormData(string $message): self
    {
        return new self("Invalid form data: $message");
    }
}
