<?php

namespace Spichka\Usl;

class AdminPage
{
    public static function register(): void
    {
        add_options_page(
            'UTM Short Links',
            'UTM Short Links',
            'manage_options',
            'utm-short-links',
            [self::class, 'render']
        );
    }

    public static function render(): void
    {
        echo '<h1>UTM Short Links</h1>';
    }

    public static function addMetaBox(): void
    {
        add_meta_box(
            'utm_short-links_meta',
            'UTM Short Links',
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
