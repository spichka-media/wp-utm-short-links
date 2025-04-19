<?php

namespace Spichka\UtmShortlinksTest;

use PHPUnit\Framework\TestCase;
use Spichka\UtmShortlinks\ShortlinkHandler;

class ShortlinkHandlerTest extends TestCase {
    public function testRegisterRewriteRules() {
        $this->assertTrue(method_exists(ShortlinkHandler::class, 'registerRewriteRules'));
    }

    public function testHandleRedirect() {
        $this->assertTrue(method_exists(ShortlinkHandler::class, 'handleRedirect'));
    }

    public function testResolveShortlink() {
        $method = new \ReflectionMethod(ShortlinkHandler::class, 'resolveShortlink');
        $method->setAccessible(true);

        $result = $method->invoke(null, 'example', 'tg');
        $this->assertStringContainsString('utm_source=telegram', $result);

        $result = $method->invoke(null, 'example', 'fb');
        $this->assertStringContainsString('utm_source=fb', $result);
    }
}
