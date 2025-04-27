<?php

namespace Spichka\Usl\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Spichka\Usl\Services\AdminPage;
use Spichka\Usl\Services\T;

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
}
