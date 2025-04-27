<?php

use Spichka\Usl\Models\SettingContainer;
use Spichka\Usl\Services\AdminPage;
use Spichka\Usl\Services\T;

/**
 * @var SettingContainer $settingContainer
 * @var AdminPage $this
 */

$colCount = 3 + count($settingContainer->getUtms());
?>

<h3><?= esc_html(T::t('admin.links.tab')) ?></h3>
<p class="description"><?= esc_html(T::t('admin.links.description')) ?></p>

<form method="post" action="">
    <?php wp_nonce_field('save_links_action'); ?>

    <table class="widefat spichka-usl-table" id="links-table">
        <thead>
        <tr>
            <th><?= esc_html(T::t('admin.links.link_code')) ?></th>
            <th><?= esc_html(T::t('admin.links.link_name')) ?></th>
            <th><?= esc_html(T::t('admin.links.link_utm_value')) ?></th>
            <th class="text-right"><?= esc_html(T::t('admin.actions.actions')) ?></th>
        </tr>
        </thead>
        <tbody>
            <?php if (empty($settingContainer->getLinks())) : ?>
                <tr class="no-items">
                    <td colspan="<?=$colCount?>">
                        <?= esc_html(T::t('admin.links.no_links')) ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($settingContainer->getLinks() as $link) : ?>
                    <tr>
                        <td>
                            <label>
                                <input type="text"
                                       name="link_code[]"
                                       value="<?= esc_attr($link->getCode()) ?>"
                                       class="regular-text"
                                       required
                                >
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="text"
                                       name="link_name[]"
                                       value="<?= esc_attr($link->getName()) ?>"
                                       class="regular-text"
                                       required
                                >
                            </label>
                        </td>
                        <td>
                            <?php foreach ($settingContainer->getUtms() as $utm) : ?>
                                <div class="mb-1">
                                    <?php $linkToUtm = $link->getLinkToUtm($utm) ?>
                                    <label class="utm-label" for="link_to_utm[<?= esc_attr($utm->getCode()) ?>][]">
                                        <?= esc_html($utm->getName()) ?>
                                    </label>
                                    <input type="text"
                                           id="link_to_utm[<?= esc_attr($utm->getCode()) ?>][]"
                                           name="link_to_utm[<?= esc_attr($utm->getCode()) ?>][]"
                                           value="<?= esc_attr($linkToUtm->getUtmValue()) ?>"
                                           class="regular-text"
                                    >
                                </div>
                            <?php endforeach ?>
                        </td>
                        <td class="pos-relative">
                            <button type="button" class="button remove-row right-bottom">
                                <?= esc_html(T::t('admin.actions.remove')) ?>
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="<?=$colCount ?>">
                    <button type="button" class="button add-row right" data-table="links">
                        <?= esc_html(T::t('admin.actions.add')) ?>
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>

    <p class="submit">
        <input type="submit"
               name="save_links"
               id="submit"
               class="button button-primary right"
               value="<?= esc_attr(T::t('admin.actions.save')) ?>"
        >
    </p>
</form>
