<?php

use Spichka\Usl\Models\Link;
use Spichka\Usl\Models\Utm;
use Spichka\Usl\Services\AdminPage;
use Spichka\Usl\Services\T;

/**
 * @var Link[] $links
 * @var Utm[] $utms
 * @var AdminPage $this
 * @var string $tab
 */
?>

<div class="wrap wp-utm-short-links">
    <h1>
        <?= esc_html(T::t('admin.title')) ?>
        <p class="description"><?= esc_html(T::t('admin.description')) ?></p>
    </h1>

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
                <?php AdminPage::renderTemplate('admin-links', [
                    'links' => $links,
                ]) ?>
            <?php endif ?>

            <?php if ($tab === 'utms') : ?>
                <?php AdminPage::renderTemplate('admin-utms', [
                    'utms' => $utms,
                ]) ?>
            <?php endif ?>
        </div>
    </div>
</div>

<?php AdminPage::renderTemplate('admin-scripts') ?>

<?php AdminPage::renderTemplate('admin-styles') ?>
