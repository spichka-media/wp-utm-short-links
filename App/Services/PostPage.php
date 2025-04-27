<?php

namespace Spichka\Usl\Services;

use WP_Post;

class PostPage
{
    use RenderedPageTrait;

    /**
     * @return void
     */
    public function register(): void
    {
        add_meta_box(
            'utm_short-links_meta',
            T::t('plugin.name'),
            [$this, 'render'],
            'post',
            'side'
        );
    }

    /**
     * @return void
     */
    public function render(WP_Post $post): void
    {
        if (!$post->ID) {
            return;
        }

        $settingService = new SettingService();
        $settingContainer = $settingService->getContainer();

        $rootUrl = get_site_url();

        $this->renderTemplate('post', [
            'settingContainer' => $settingContainer,
            'rootUrl' => $rootUrl,
            'post' => $post,
        ]);
    }
}
