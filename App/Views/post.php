<?php

use Spichka\Usl\Models\SettingContainer;
use Spichka\Usl\Services\T;

/**
 * @var SettingContainer $settingContainer
 * @var string $rootUrl
 * @var WP_Post $post
 */
?>

<div>
    <?php foreach ($settingContainer->getLinks() as $link) : ?>
        <?php $fullLink = urldecode("$rootUrl/{$link->getCode()}/$post->post_name") ?>
        <?php $displayLink = urldecode("/{$link->getCode()}/$post->post_name") ?>

        <div class="usl-link-item">
            <a href="#"
               class="usl-copy-button"
               data-clipboard-text="<?= $fullLink ?>"
               title="<?= esc_attr(T::t('post.copy_link'))?>"
            >
                <span class="dashicons dashicons-clipboard"></span>
            </a>
            <span class="usl-link-name"><?= $link->getName() ?>: </span>
            <a target="_blank" href="<?= $fullLink ?>" class="usl-external-link">
                <?= $displayLink ?>
                <span class="dashicons dashicons-external"></span>
            </a>
        </div>
    <?php endforeach ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.usl-copy-button');
        copyButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const textToCopy = this.getAttribute('data-clipboard-text');
                navigator.clipboard.writeText(textToCopy)
                    .then(() => {
                        const originalIcon = this.querySelector('.dashicons');
                        const originalClass = originalIcon.className;

                        originalIcon.className = 'dashicons dashicons-yes';

                        setTimeout(() => {
                            originalIcon.className = originalClass;
                        }, 1500);
                    })
                    .catch(err => {
                        console.error('Ошибка копирования: ', err);
                    });
            });
        });
    });
</script>

<style>
    .usl-link-item {
        display: flex;
        align-items: center;
    }
    .usl-link-name {
        margin-left: 15px;
        font-weight: 600;
        color: #1d2327;
    }
    .usl-copy-button {
        color: #2271b1;
        text-decoration: none;
        padding: 2px 5px;
        border-radius: 3px;
    }
    .usl-copy-button:hover {
        background: #f0f0f1;
        color: #135e96;
    }
    .usl-external-link {
        color: #2271b1;
        margin-left: 15px;
        text-decoration: none;
        display: flex;
        align-items: center;
    }
    .usl-external-link .dashicons {
        font-size: 14px;
        width: 14px;
        height: 14px;
        margin-left: 3px;
    }
    .usl-external-link:hover {
        color: #135e96;
        text-decoration: underline;
    }
</style>
