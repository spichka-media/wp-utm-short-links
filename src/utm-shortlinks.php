<?php
/**
 * Plugin Name: UTM Short Links
 * Description: A WordPress plugin for creating short links on posts with UTM and other GET parameters
 * Version: 1.0.0
 * Author: KR2090
 * License: GPL-3.0-or-later
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/helpers.php';

use Spichka\UtmShortlinks\AdminPage;
use Spichka\UtmShortlinks\ShortlinkHandler;

// Register admin menu
add_action('admin_menu', function () {
    AdminPage::register();
});

// Short links handler
add_action('init', function () {
    ShortlinkHandler::registerRewriteRules();
    ShortlinkHandler::handleRedirect();
});

// Add page functions
add_action('add_meta_boxes', function () {
    AdminPage::addMetaBox();
});
