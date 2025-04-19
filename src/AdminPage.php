<?php

namespace Spichka\UtmShortlinks;

class AdminPage {
    public static function register() {
        add_options_page(
            'UTM Short Links',
            'UTM Short Links',
            'manage_options',
            'utm-shortlinks',
            [self::class, 'render']
        );
    }

    public static function render() {
        echo '<h1>UTM Short Links</h1>';
    }

    public static function addMetaBox() {
        add_meta_box(
            'utm_shortlinks_meta',
            'UTM Shortlinks',
            [self::class, 'renderMetaBox'],
            'post',
            'side'
        );
    }

    public static function renderMetaBox($post) {
        echo '<p>Link list:</p>';
    }
}
