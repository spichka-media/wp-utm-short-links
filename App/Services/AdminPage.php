<?php

namespace Spichka\Usl\Services;

use Spichka\Usl\Models\Link;
use Spichka\Usl\Models\Utm;

class AdminPage
{
    use RenderedPageTrait;

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
        $utms = get_option('wp-utm-short-links-utms', null);
        if (!is_array($utms)) {
            // First initialization
            $utms = [
                new Utm('utm_source', T::t('utm.utm_source')),
                new Utm('utm_medium', T::t('utm.utm_medium')),
                new Utm('utm_campaign', T::t('utm.utm_campaign')),
                new Utm('utm_term', T::t('utm.utm_term')),
                new Utm('utm_content', T::t('utm.utm_content')),
            ];
        }

        $links = get_option('wp-utm-short-links-links', []);
        if (!is_array($links)) {
            // First initialization
            $links = [
                new Link(T::t('link.source'), 'tg', []),
            ];
        }

        self::renderTemplate('admin', [
            'utms' => $utms,
            'links' => $links,
            'tab' => $_GET['tab'] ?? 'links',
        ]);
    }
}
