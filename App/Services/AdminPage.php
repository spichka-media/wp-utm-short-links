<?php

namespace Spichka\Usl\Services;

class AdminPage
{
    use RenderedPageTrait;

    /**
     * @return void
     */
    public function register(): void
    {
        add_options_page(
            T::t('plugin.name'),
            T::t('plugin.name'),
            'manage_options',
            'wp-utm-short-links',
            [$this, 'render']
        );
    }

    /**
     * @return void
     */
    public function render(): void
    {
        $settingService = new SettingService();
        $settingContainer = $settingService->getContainer();

        $settingService->updateByPost($settingContainer, $_POST);

        $this->renderTemplate('admin', [
            'settingContainer' => $settingContainer,
            'tab' => $_GET['tab'] ?? 'links',
            'isPermalink' => (bool)get_option('permalink_structure'),
        ]);
    }
}
