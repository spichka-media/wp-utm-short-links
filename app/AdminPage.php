<?php

namespace Spichka\Usl;

class AdminPage
{
    public static function register(): void
    {
        add_options_page(
            T::t('plugin.name'),
            T::t('plugin.name'),
            'manage_options',
            'wp-utm-short-links',
            [self::class, 'render']
        );
    }

    public static function render(): void
    {
        echo '<h1>' . T::t('plugin.name') . '</h1>';
    }

    public static function addMetaBox(): void
    {
        add_meta_box(
            'utm_short-links_meta',
            T::t('plugin.name'),
            [self::class, 'renderMetaBox'],
            'post',
            'side'
        );
    }

    public static function renderMetaBox($post): void
    {
        echo '<p>Link list:</p>';
    }
}
