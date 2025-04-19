<?php

namespace Spichka\UtmShortlinksTest;

use PHPUnit\Framework\TestCase;
use function Spichka\UtmShortlinks\generateUtmLink;

class HelpersTest extends TestCase {
    public function testGenerateUtmLink() {
        $baseUrl = 'https://example.com';
        $params = ['utm_source' => 'telegram', 'utm_medium' => 'social'];

        $result = generateUtmLink($baseUrl, $params);
        $this->assertEquals('https://example.com?utm_source=telegram&utm_medium=social', $result);
    }
}
