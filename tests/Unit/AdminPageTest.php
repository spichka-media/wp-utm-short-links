<?php

namespace Spichka\Usl\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Spichka\Usl\AdminPage;

class AdminPageTest extends TestCase
{
    public function testRegister()
    {
        $this->assertTrue(method_exists(AdminPage::class, 'register'));
    }

    public function testRender()
    {
        $this->expectOutputString('<h1>UTM Short Links</h1>');
        AdminPage::render();
    }

    public function testAddMetaBox()
    {
        $this->assertTrue(method_exists(AdminPage::class, 'addMetaBox'));
    }

    public function testRenderMetaBox()
    {
        $this->expectOutputRegex('/<p>Link list:<\/p>/');
        AdminPage::renderMetaBox(null);
    }
}
