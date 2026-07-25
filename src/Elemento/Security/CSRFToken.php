<?php

namespace Elemento\Security;

use Random\RandomException;
use RuntimeException;

class CSRFToken
{
    private static string $sessionKey = '_elemento_csrf_token';
    private static int $tokenLength = 32;

    /**
     * Generate a CSRF token
     *
     * @return string
     * @throws RandomException
     */
    public static function generate(): string
    {
        if (!self::hasToken()) {
            self::createToken();
        }

        return self::getToken();
    }

    /**
     * Create a new CSRF token
     *
     * @return void
     * @throws RandomException
     */
    private static function createToken(): void
    {
        self::ensureActiveSession();

        $_SESSION[self::$sessionKey] = bin2hex(random_bytes(self::$tokenLength));
    }

    /**
     * Get the current CSRF token
     *
     * @return string
     * @throws RandomException
     */
    public static function getToken(): string
    {
        self::ensureActiveSession();

        if (!self::hasToken()) {
            self::createToken();
        }

        return $_SESSION[self::$sessionKey];
    }

    /**
     * Check if a CSRF token exists
     *
     * @return bool
     */
    public static function hasToken(): bool
    {
        self::ensureActiveSession();

        return isset($_SESSION[self::$sessionKey]);
    }

    /**
     * Verify CSRF token
     *
     * @param string $token
     * @return bool
     * @throws RandomException
     */
    public static function verify(string $token): bool
    {
        $currentToken = self::getToken();

        return hash_equals($currentToken, $token);
    }

    /**
     * Create a new CSRF token (refresh)
     *
     * @return string
     * @throws RandomException
     */
    public static function refresh(): string
    {
        self::ensureActiveSession();

        $_SESSION[self::$sessionKey] = bin2hex(random_bytes(self::$tokenLength));

        return $_SESSION[self::$sessionKey];
    }

    /**
     * Destroy the current CSRF token
     *
     * @return void
     */
    public static function destroy(): void
    {
        self::ensureActiveSession();

        unset($_SESSION[self::$sessionKey]);
    }

    /**
     * Set a custom session key
     *
     * @param string $key
     * @return void
     */
    public static function setSessionKey(string $key): void
    {
        self::$sessionKey = $key;
    }

    /**
     * Set the CSRF token length
     *
     * @param int $length
     * @return void
     */
    public static function setTokenLength(int $length = 32): void
    {
        self::$tokenLength = max(16, $length);
    }

    /**
     * Ensure the application has started a session before using CSRF storage.
     *
     * @return void
     */
    private static function ensureActiveSession(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            throw new RuntimeException('An active PHP session is required to manage CSRF tokens. Start the session before calling Elemento CSRF helpers.');
        }
    }
}
