<?php

namespace Elemento\Macro;

use RuntimeException;

class MacroRegistry
{
    private static array $macros = [];

    /**
     * Register a macro
     *
     * @param string $name
     * @param callable $callback
     * @return void
     */
    public static function register(string $name, callable $callback): void
    {
        self::$macros[$name] = $callback;
    }

    /**
     * Call a registered macro
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function call(string $name, array $arguments): mixed
    {
        if (!self::exists($name)) {
            throw new RuntimeException("Macro '$name' not found.");
        }

        return call_user_func_array(self::$macros[$name], $arguments);
    }

    /**
     * Check if a macro exists
     *
     * @param string $name
     * @return bool
     */
    public static function exists(string $name): bool
    {
        return isset(self::$macros[$name]);
    }

    /**
     * Get all registered macros
     *
     * @return array
     */
    public static function all(): array
    {
        return self::$macros;
    }

    /**
     * Remove a registered macro
     *
     * @param string $name
     * @return void
     */
    public static function remove(string $name): void
    {
        unset(self::$macros[$name]);
    }

    /**
     * Clear all registered macros
     *
     * @return void
     */
    public static function clear(): void
    {
        self::$macros = [];
    }

    /**
     * Count all registered macros
     *
     * @return int
     */
    public static function count(): int
    {
        return count(self::$macros);
    }
}
