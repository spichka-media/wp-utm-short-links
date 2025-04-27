<?php

use Spichka\Usl\Models\SettingContainer;
use Spichka\Usl\Services\AdminPage;
use Spichka\Usl\Services\T;

/**
 * @var $settingContainer SettingContainer
 * @var AdminPage $this
 */
?>

<h3><?= esc_html(T::t('admin.utms.tab')) ?></h3>
<p class="description"><?= esc_html(T::t('admin.utms.description')) ?></p>

<form method="post" action="">
    <?php wp_nonce_field('save_utms_action'); ?>

    <table class="widefat spichka-usl-table" id="utms-table">
        <thead>
        <tr>
            <th><?= esc_html(T::t('admin.utms.utm_name')) ?></th>
            <th><?= esc_html(T::t('admin.utms.utm_code')) ?></th>
            <th class="text-right"><?= esc_html(T::t('admin.actions.actions')) ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if (!$settingContainer->utms) : ?>
            <tr class="no-items">
                <td colspan="3"><?= esc_html(T::t('admin.utms.no_utms')) ?></td>
            </tr>
        <?php else : ?>
            <?php foreach ($settingContainer->utms as $utm) : ?>
                <tr>
                    <td>
                        <label>
                            <input type="text"
                                   name="utm_name[]"
                                   value="<?= esc_attr($utm->name) ?>"
                                   class="regular-text"
                                   required
                            >
                        </label>
                    </td>
                    <td>
                        <label>
                            <input type="text"
                                   name="utm_code[]"
                                   value="<?= esc_attr($utm->code) ?>"
                                   class="regular-text"
                                   required
                            >
                        </label>
                    </td>
                    <td>
                        <button type="button" class="button remove-row right">
                            <?= esc_html(T::t('admin.actions.remove')) ?>
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3">
                <button type="button" class="button add-row right" data-table="utms">
                    <?= esc_html(T::t('admin.actions.add')) ?>
                </button>
            </td>
        </tr>
        </tfoot>
    </table>

    <p class="submit">
        <input type="submit"
               name="save_utms"
               id="submit-utms"
               class="button button-primary right"
               value="<?= esc_attr(T::t('admin.actions.save')) ?>"
        >
    </p>
</form>
