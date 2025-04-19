<?php

namespace Spichka\Usl\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Spichka\Usl\Handler;

class HandlerTest extends TestCase
{
    public function testRegisterRewriteRules(): void
    {
        $this->assertTrue(method_exists(Handler::class, 'registerRewriteRules'));
    }

    public function testHandleRedirect(): void
    {
        $this->assertTrue(method_exists(Handler::class, 'handleRedirect'));
    }

    public function testResolveShortlink(): void
    {
        $method = new \ReflectionMethod(Handler::class, 'resolveShortlink');
        $method->setAccessible(true);

        $result = $method->invoke(null, 'example', 'tg');
        $this->assertStringContainsString('utm_source=telegram', $result);

        $result = $method->invoke(null, 'example', 'fb');
        $this->assertStringContainsString('utm_source=fb', $result);
    }
}
