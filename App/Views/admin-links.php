<?php

use Spichka\Usl\Models\Link;
use Spichka\Usl\Services\AdminPage;
use Spichka\Usl\Services\T;

/**
 * @var Link[] $links
 * @var AdminPage[] $this
 */
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
            <th><?= esc_html(T::t('admin.actions.actions')) ?></th>
        </tr>
        </thead>
        <tbody>
            <?php if (empty($links)) : ?>
                <tr class="no-items">
                    <td colspan="3"><?= esc_html(T::t('admin.links.no_links')) ?></td>
                </tr>
            <?php else : ?>
                <?php foreach ($links as $index => $link) : ?>
                    <tr>
                        <td>
                            <input type="text"
                                   name="link_code[]"
                                   value="<?= esc_attr($link->code) ?>"
                                   class="regular-text"
                                   required
                            >
                        </td>
                        <td>
                            <input type="text"
                                   name="link_name[]"
                                   value="<?= esc_attr($link->name) ?>"
                                   class="regular-text"
                                   required
                            >
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
