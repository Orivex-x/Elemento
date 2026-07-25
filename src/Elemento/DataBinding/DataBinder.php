<?php

namespace Elemento\DataBinding;

use InvalidArgumentException;
use stdClass;

class DataBinder
{
    /**
     * Bind data to an object with type coercion
     *
     * @param mixed $data
     * @return object
     */
    public static function bind(mixed $data): object
    {
        if ($data === null) {
            return new stdClass();
        }

        if (is_object($data)) {
            return $data;
        }

        if (is_array($data)) {
            return (object) $data;
        }

        return new stdClass();
    }

    /**
     * Extract value from a data object/array using dot notation
     *
     * @param mixed $data
     * @param string $path
     * @param mixed|null $default
     * @return mixed
     */
    public static function getValue(mixed $data, string $path, mixed $default = null): mixed
    {
        $data = self::bind($data);

        $keys = explode('.', $path);
        $value = $data;

        foreach ($keys as $key) {
            if (is_object($value)) {
                if (!isset($value->$key)) {
                    return $default;
                }

                $value = $value->$key;
            } elseif (is_array($value)) {
                if (!isset($value[$key])) {
                    return $default;
                }

                $value = $value[$key];
            } else {
                return $default;
            }
        }

        return $value;
    }

    /**
     * Set a value in a data object using dot notation
     *
     * @param mixed $data
     * @param string $path
     * @param mixed $value
     * @return void
     */
    public static function setValue(mixed &$data, string $path, mixed $value): void
    {
        if (!is_array($data) && !is_object($data)) {
            $data = new stdClass();
        }

        self::ensureMutableData($data);

        $keys = explode('.', $path);
        $current = &$data;

        foreach ($keys as $key) {
            if (is_array($current)) {
                if (!array_key_exists($key, $current) || (!is_array($current[$key]) && !is_object($current[$key]))) {
                    $current[$key] = [];
                }

                $current = &$current[$key];

                continue;
            }

            self::ensureMutableData($current);

            if (!isset($current->$key) || (!is_array($current->$key) && !is_object($current->$key))) {
                $current->$key = new stdClass();
            }

            $current = &$current->$key;
        }

        $current = $value;
    }

    /**
     * Hydrate a stdClass instance from an array.
     *
     * @param object $object
     * @param array $data
     * @return object
     */
    public static function hydrate(object $object, array $data): object
    {
        self::ensureMutableData($object);

        foreach ($data as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    /**
     * Check if a value exists
     *
     * @param mixed $data
     * @param string $path
     * @return bool
     */
    public static function has(mixed $data, string $path): bool
    {
        $data = self::bind($data);
        $keys = explode('.', $path);
        $value = $data;

        foreach ($keys as $key) {
            if (is_object($value)) {
                if (!isset($value->$key)) {
                    return false;
                }

                $value = $value->$key;
            } elseif (is_array($value)) {
                if (!isset($value[$key])) {
                    return false;
                }

                $value = $value[$key];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * Ensure the value can be safely mutated without creating dynamic properties on user classes.
     *
     * @param mixed $data
     * @return void
     */
    private static function ensureMutableData(mixed $data): void
    {
        if (is_object($data) && !$data instanceof stdClass) {
            throw new InvalidArgumentException('Data mutation is supported only for arrays and stdClass instances.');
        }
    }
}
