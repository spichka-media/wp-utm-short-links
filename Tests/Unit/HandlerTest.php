<?php

namespace Spichka\Usl\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Spichka\Usl\Services\RedirectHandler;

class HandlerTest extends TestCase
{
    public function testRegisterRewriteRules(): void
    {
        $this->assertTrue(method_exists(RedirectHandler::class, 'register'));
    }

    public function testHandleRedirect(): void
    {
        $this->assertTrue(method_exists(RedirectHandler::class, 'handle'));
    }

    public function testResolveShortlink(): void
    {
        $method = new \ReflectionMethod(RedirectHandler::class, 'handle');
        $method->setAccessible(true);

        $result = $method->invoke(null, 'example', 'tg');
        $this->assertStringContainsString('utm_source=telegram', $result);

        $result = $method->invoke(null, 'example', 'fb');
        $this->assertStringContainsString('utm_source=fb', $result);
    }
}
