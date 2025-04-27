<?php

namespace Spichka\Usl\Services;

use Spichka\Usl\Models\Link;
use Spichka\Usl\Models\LinkToUtm;
use Spichka\Usl\Models\SettingContainer;
use Spichka\Usl\Models\Utm;
use Throwable;

class SettingService
{
    /**
     * @return SettingContainer
     */
    public function getContainer(): SettingContainer
    {
        try {
            $linksContainer = get_option('wp-utm-short-links-setting');
        } catch (Throwable) {
            $linksContainer = null;
        }

        if (!($linksContainer instanceof SettingContainer)) {
            // Serialization errors and others
            return $this->createDefaultContainer();
        }

        return $linksContainer;
    }

    /**
     * @return SettingContainer
     */
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
                'inst',
                T::t('link.instagram'),
                [
                    new LinkToUtm($utmSource, 'instagram'),
                ],
            ),
            new Link(
                'tg',
                T::t('link.telegram'),
                [
                    new LinkToUtm($utmSource, 'telegram'),
                ],
            ),
        ];

        return new SettingContainer($utms, $links);
    }

    /**
     * @param SettingContainer $settingContainer
     * @param array<string, mixed> $post
     * @return void
     */
    public function updateByPost(SettingContainer $settingContainer, array $post): void
    {
        if (isset($post['save_links'])) {
            $settingContainer->updateLinks($post['link_name'], $post['link_code'], $post['link_to_utm']);
        } elseif (isset($post['save_utms'])) {
            $settingContainer->updateUtms($post['utm_name'], $post['utm_code']);
        }

        update_option('wp-utm-short-links-setting', $settingContainer);
    }
}
