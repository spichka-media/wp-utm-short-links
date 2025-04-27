<?php

namespace Spichka\Usl\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Spichka\Usl\Services\PostPage;
use Spichka\Usl\Services\T;

class PostPageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        T::init();
    }

    public function testRegister(): void
    {
        $this->assertTrue(method_exists(PostPage::class, 'register'));
    }

    public function testRender(): void
    {
        $this->expectOutputRegex('/<p>Link list:<\/p>/');
        PostPage::render(null);
    }
}
