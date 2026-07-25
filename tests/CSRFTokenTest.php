<?php

namespace tests;

use Elemento\Security\CSRFToken;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class CSRFTokenTest extends TestCase
{
    protected function tearDown(): void
    {
        CSRFToken::destroy();
        CSRFToken::setSessionKey('_elemento_csrf_token');
        CSRFToken::setTokenLength();
    }

    public function testGeneratesAndVerifiesToken(): void
    {
        $token = CSRFToken::generate();

        self::assertTrue(CSRFToken::verify($token));
        self::assertFalse(CSRFToken::verify('invalid'));
    }

    public function testRequiresAnActiveSession(): void
    {
        session_write_close();

        try {
            $this->expectException(RuntimeException::class);
            CSRFToken::generate();
        } finally {
            session_start();
        }
    }

    public function testAllCsrfOperationsRequireAnActiveSession(): void
    {
        session_write_close();

        try {
            $this->expectException(RuntimeException::class);
            CSRFToken::hasToken();
        } finally {
            session_start();
        }
    }

    public function testSupportsCustomKeysRefreshAndDestruction(): void
    {
        CSRFToken::setSessionKey('_test_token');
        CSRFToken::setTokenLength(16);
        $first = CSRFToken::generate();
        $second = CSRFToken::refresh();

        self::assertSame(32, strlen($first));
        self::assertSame(32, strlen($second));
        self::assertNotSame($first, $second);
        self::assertTrue(CSRFToken::hasToken());

        CSRFToken::destroy();

        self::assertFalse(CSRFToken::hasToken());
    }
}
