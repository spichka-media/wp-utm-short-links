<?php
/**
 * Plugin Name: UTM Short Links
 * Plugin URI https://github.com/spichka-media/wp-utm-short-links
 * Description: A WordPress plugin for creating short links on posts with UTM and other GET parameters
 * Version: 1.0.0
 * Author: KR2090
 * License: GPL-3.0-or-later
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

use Spichka\Usl\AdminPage;
use Spichka\Usl\Handler;

// Register admin menu
add_action('admin_menu', function () {
    AdminPage::register();
});

// Short links handler
add_action(
    'init',
    function () {
        Handler::registerRewriteRules();
        Handler::handleRedirect();
    }
);

// Add page functions
add_action('add_meta_boxes', function () {
    AdminPage::addMetaBox();
});
