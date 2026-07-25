<?php

namespace Elemento\Attributes;

use InvalidArgumentException;
use Stringable;

class AttributeManager implements Stringable
{
    private array $attributes = [];
    private array $booleanAttributes = [
        'disabled', 'readonly', 'required', 'checked', 'selected',
        'defer', 'declare', 'noresize', 'compact', 'ismap', 'noshade',
        'nowrap', 'multiple', 'novalidate', 'formnovalidate', 'autofocus',
        'autoplay', 'controls', 'loop', 'muted', 'async', 'default', 'hidden',
        'nomodule', 'open', 'reversed', 'sandbox'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Set an attribute
     *
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public function set(string $key, mixed $value): self
    {
        if (!preg_match('/^[A-Za-z_:][A-Za-z0-9:._-]*$/', $key)) {
            throw new InvalidArgumentException("Invalid HTML attribute name: $key");
        }

        // Don't set empty class attributes
        if ($key === 'class' && empty($value)) {
            unset($this->attributes[$key]);

            return $this;
        }

        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * Get an attribute
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Check if an attribute exists
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Remove an attribute
     *
     * @param string $key
     * @return self
     */
    public function remove(string $key): self
    {
        unset($this->attributes[$key]);

        return $this;
    }

    /**
     * Get all attributes
     *
     * @return array
     */
    public function all(): array
    {
        return $this->attributes;
    }

    /**
     * Clear all attributes
     *
     * @return self
     */
    public function clear(): self
    {
        $this->attributes = [];

        return $this;
    }

    /**
     * Merge attributes
     *
     * @param array $attributes
     * @return self
     */
    public function merge(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    /**
     * Render attributes to HTML string
     *
     * @return string
     */
    public function __toString(): string
    {
        $html = '';

        foreach ($this->attributes as $key => $value) {
            if ($value === null || $value === false) {
                continue;
            }

            // Boolean attributes
            if (in_array($key, $this->booleanAttributes)) {
                if ($value === true) {
                    $html .= " $key";
                }

                continue;
            }

            // Regular attributes
            if (is_array($value)) {
                $value = implode(' ', $value);
            } elseif (is_bool($value)) {
                $value = 'true';
            }

            $escapedValue = htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $html .= " $key=\"$escapedValue\"";
        }

        return $html;
    }

    /**
     * Clone the attributes' array with deep copy
     * @return void
     */
    public function __clone()
    {
        $this->attributes = array_map(function ($value) {
            if (is_array($value)) {
                return array_values($value);
            }

            return $value;
        }, $this->attributes);
    }
}
