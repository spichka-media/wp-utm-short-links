<?php

namespace Spichka\Usl\Services;

class PostPage
{
    use RenderedPageTrait;

    public static function register(): void
    {
        add_meta_box(
            'utm_short-links_meta',
            T::t('plugin.name'),
            [self::class, 'render'],
            'post',
            'side'
        );
    }

    public static function render($post): void
    {
        self::renderTemplate('post', [
            'post' => $post,
        ]);
    }
}
