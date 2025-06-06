<?php

use Spichka\Usl\Models\SettingContainer;
use Spichka\Usl\Services\T;

/**
 * @var SettingContainer $settingContainer
 */

?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // New row creation
        $('.add-row').on('click', function() {
            const tableType = $(this).data('table')
            let tableBody
            let newRow

            if (tableType === 'links') {
                tableBody = $('#links-table tbody')
                newRow = `
                    <tr>
                        <td><input type="text" name="link_code[]" class="regular-text" required></td>
                        <td><input type="text" name="link_name[]" class="regular-text" required></td>
                        <td>
                            <?php foreach ($settingContainer->getUtms() as $utm) : ?>
                                <div class="mb-1">
                                    <label class="utm-label" for="link_to_utm[<?= esc_attr($utm->getCode()) ?>][]">
                                        <?= esc_html($utm->getName()) ?>
                                    </label>
                                    <input type="text"
                                           id="link_to_utm[<?= esc_attr($utm->getCode()) ?>][]"
                                           name="link_to_utm[<?= esc_attr($utm->getCode()) ?>][]"
                                           value=""
                                           class="regular-text"
                                    >
                                </div>
                            <?php endforeach ?>
                        </td>
                        <td class="pos-relative">
                            <button type="button" class="button remove-row right-bottom">
                                <?= esc_js(T::t('admin.actions.remove')) ?>
                            </button>
                        </td>
                    </tr>
                `
            } else {
                tableBody = $('#utms-table tbody')
                newRow = `
                    <tr>
                        <td><input type="text" name="utm_code[]" class="regular-text" required></td>
                        <td><input type="text" name="utm_name[]" class="regular-text" required></td>
                        <td>
                            <button type="button" class="button remove-row right">
                                <?= esc_js(T::t('admin.actions.remove')) ?>
                            </button>
                        </td>
                    </tr>
                `
            }

            // Remove empty message if exists
            tableBody.find('.no-items').remove()

            // Add created row
            tableBody.append(newRow)
        })

        // Remove row
        $(document).on('click', '.remove-row', function() {
            const tableBody = $(this).closest('tbody')
            $(this).closest('tr').remove()

            // If removed last row, show empty message
            if (tableBody.children('tr').length === 0) {
                const columnCount = tableBody.closest('table').find('thead th').length
                let emptyMessage = '<?= esc_js(T::t('admin.no_items')) ?>'

                if (tableBody.closest('table').attr('id') === 'links-table') {
                    emptyMessage = '<?= esc_js(T::t('admin.links.no_links')) ?>'
                } else if (tableBody.closest('table').attr('id') === 'utms-table') {
                    emptyMessage = '<?= esc_js(T::t('admin.utms.no_utms')) ?>'
                }

                tableBody.append(`
                    <tr class="no-items">
                        <td colspan="${columnCount}">${emptyMessage}</td>
                    </tr>
                `)
            }
        })
    })
</script>

