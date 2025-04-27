<?php

namespace Spichka\Usl\Services;

use Spichka\Usl\Models\Link;
use Spichka\Usl\Models\LinkToUtm;
use Spichka\Usl\Models\SettingContainer;
use Spichka\Usl\Models\Utm;
use Throwable;

class SettingService
{
    public function getContainer(): SettingContainer
    {
        try {
            $linksContainer = get_option('wp-utm-short-links-setting');
        } catch (Throwable) {
            $linksContainer = null;
        }

        if (!($linksContainer instanceof SettingContainer)) {
            // Serrialization errors and others
            return $this->createDefaultContainer();
        }

        return $linksContainer;
    }

    private function createDefaultContainer(): SettingContainer
    {
        $utms = [
            $utmSource = new Utm('utm_source', T::t('utm.utm_source')),
            new Utm('utm_medium', T::t('utm.utm_medium')),
            new Utm('utm_campaign', T::t('utm.utm_campaign')),
            new Utm('utm_term', T::t('utm.utm_term')),
            new Utm('utm_content', T::t('utm.utm_content')),
        ];

        $links = [
            new Link(
                T::t('link.instagram'),
                'inst',
                [
                    new LinkToUtm($utmSource, 'instagram'),
                ],
            ),
            new Link(
                T::t('link.telegram'),
                'tg',
                [
                    new LinkToUtm($utmSource, 'telegram'),
                ],
            ),
        ];

        return new SettingContainer($utms, $links);
    }
}
