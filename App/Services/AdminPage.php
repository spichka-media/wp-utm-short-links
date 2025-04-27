<?php

namespace Spichka\Usl\Services;

class AdminPage
{
    use RenderedPageTrait;

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

    public function render(): void
    {
        $settingService = new SettingService();
        $settingContainer = $settingService->getContainer();

        $this->renderTemplate('admin', [
            'settingContainer' => $settingContainer,
            'tab' => $_GET['tab'] ?? 'links',
        ]);
    }
}
