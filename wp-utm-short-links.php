<?php

/**
 * Plugin Name: UTM Short Links
 * Plugin URI https://github.com/spichka-media/wp-utm-short-links
 * Description: A WordPress plugin for creating short links on posts with UTM and other GET parameters
 * Version: 1.0.0
 * Author: https://spichka.media
 * License: GPL-3.0-or-later
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use Spichka\Usl\Services\AdminPage;
use Spichka\Usl\Services\PostPage;
use Spichka\Usl\Services\RedirectHandler;
use Spichka\Usl\Services\T;

// Initialize the plugin resources
add_action('after_setup_theme', function () {
    T::init(get_option('WPLANG', 'en'));
});

// Register admin menu
add_action('admin_menu', function () {
    AdminPage::register();
});

// Add page functions
add_action('add_meta_boxes', function () {
    PostPage::register();
});

// Short links handler
add_action(
    'init',
    function () {
        RedirectHandler::register();
        RedirectHandler::handle();
    }
);
