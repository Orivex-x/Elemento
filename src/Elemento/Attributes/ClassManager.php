<?php

namespace Elemento\Attributes;

use Stringable;

class ClassManager implements Stringable
{
    private array $classes = [];

    /**
     * @param string $classes
     */
    public function __construct(string $classes = '')
    {
        if (!empty($classes)) {
            $this->classes = array_filter(
                array_map('trim', explode(' ', $classes)),
                fn ($c) => !empty($c)
            );
        }
    }

    /**
     * Add CSS classes
     *
     * @param string ...$classes
     * @return self
     */
    public function add(string ...$classes): self
    {
        foreach ($classes as $class) {
            $class = trim($class);

            if (!empty($class) && !in_array($class, $this->classes)) {
                $this->classes[] = $class;
            }
        }

        return $this;
    }

    /**
     * Remove CSS classes
     *
     * @param string ...$classes
     * @return $this
     */
    public function remove(string ...$classes): self
    {
        foreach ($classes as $class) {
            $this->classes = array_filter(
                $this->classes,
                fn ($c) => $c !== $class
            );
        }

        $this->classes = array_values($this->classes);

        return $this;
    }

    /**
     * Toggle a CSS class
     *
     * @param string $class
     * @return $this
     */
    public function toggle(string $class): self
    {
        if (in_array($class, $this->classes)) {
            $this->remove($class);
        } else {
            $this->add($class);
        }

        return $this;
    }

    /**
     * Check if CSS class exists
     *
     * @param string $class
     * @return bool
     */
    public function has(string $class): bool
    {
        return in_array($class, $this->classes);
    }

    /**
     * Get all CSS classes
     *
     * @return array
     */
    public function all(): array
    {
        return $this->classes;
    }

    /**
     * Clear all CSS classes
     *
     * @return $this
     */
    public function clear(): self
    {
        $this->classes = [];

        return $this;
    }

    /**
     * Count CSS classes
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->classes);
    }

    /**
     * Render classes to string
     *
     * @return string
     */
    public function __toString(): string
    {
        return implode(' ', $this->classes);
    }

    /**
     * Clone CSS classes
     *
     * @return void
     */
    public function __clone()
    {
        $this->classes = array_values($this->classes);
    }
}
