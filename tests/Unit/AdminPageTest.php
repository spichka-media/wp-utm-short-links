<?php

namespace Spichka\Usl\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Spichka\Usl\AdminPage;
use Spichka\Usl\T;

class AdminPageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        T::init();
    }

    public function testRegister(): void
    {
        $this->assertTrue(method_exists(AdminPage::class, 'register'));
    }

    public function testRender(): void
    {
        $this->expectOutputString('<h1>UTM Links</h1>');
        AdminPage::render();
    }

    public function testAddMetaBox(): void
    {
        $this->assertTrue(method_exists(AdminPage::class, 'addMetaBox'));
    }

    public function testRenderMetaBox(): void
    {
        $this->expectOutputRegex('/<p>Link list:<\/p>/');
        AdminPage::renderMetaBox(null);
    }
}
