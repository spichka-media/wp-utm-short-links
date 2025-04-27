<?php

use Spichka\Usl\Models\Link;
use Spichka\Usl\Models\SettingContainer;
use Spichka\Usl\Services\AdminPage;
use Spichka\Usl\Services\T;

/**
 * @var Link[] $links
 * @var SettingContainer $settingContainer
 * @var AdminPage $this
 * @var string $tab
 */
?>

<div class="wrap wp-utm-short-links">
    <h1>
        <?= esc_html(T::t('admin.title')) ?>
        <p class="description mt-2"><?= esc_html(T::t('admin.description')) ?></p>
    </h1>

    <?php if ($_POST) : ?>
        <div class="notice notice-success is-dismissible">
            <p><?= esc_html(T::t('admin.saved_successfully')) ?></p>
        </div>
    <?php endif ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=wp-utm-short-links&tab=links"
           class="nav-tab <?= $tab === 'links' ? 'nav-tab-active' : ''; ?>"
        >
            <?= esc_html(T::t('admin.links.tab')) ?>
        </a>
        <a href="?page=wp-utm-short-links&tab=utms"
           class="nav-tab <?= $tab === 'utms' ? 'nav-tab-active' : ''; ?>"
        >
            <?= esc_html(T::t('admin.utms.tab')) ?>
        </a>
    </h2>

    <div class="tab-content">
        <div class="tab-pane active">
            <?php if ($tab === 'links') : ?>
                <?php $this->renderTemplate('admin-links', [
                    'settingContainer' => $settingContainer,
                ]) ?>
            <?php endif ?>

            <?php if ($tab === 'utms') : ?>
                <?php $this->renderTemplate('admin-utms', [
                    'settingContainer' => $settingContainer,
                ]) ?>
            <?php endif ?>
        </div>
    </div>
</div>

<?php $this->renderTemplate('admin-scripts', [
    'settingContainer' => $settingContainer,
]) ?>

<?php $this->renderTemplate('admin-styles') ?>
