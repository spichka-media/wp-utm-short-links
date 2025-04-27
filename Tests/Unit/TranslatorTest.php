<?php

namespace Spichka\Usl\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Spichka\Usl\Services\T;

class TranslatorTest extends TestCase
{
    public function testDefault(): void
    {
        T::init();
        $this->assertEquals('UTM Links', T::t('plugin.name'));

        T::init('fr_FR');
        $this->assertEquals('UTM Links', T::t('plugin.name'));
    }

    public function testEn(): void
    {
        T::init('en');
        $this->assertEquals('UTM Links', T::t('plugin.name'));

        T::init('en_US');
        $this->assertEquals('UTM Links', T::t('plugin.name'));
    }

    public function testRu(): void
    {
        T::init('ru');
        $this->assertEquals('UTM Ссылки', T::t('plugin.name'));

        T::init('ru_RU');
        $this->assertEquals('UTM Ссылки', T::t('plugin.name'));
    }
}
