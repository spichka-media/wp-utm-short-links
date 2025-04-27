<?php

namespace Spichka\Usl\Services;

class PostPage
{
    use RenderedPageTrait;

    public function register(): void
    {
        add_meta_box(
            'utm_short-links_meta',
            T::t('plugin.name'),
            [$this, 'render'],
            'post',
            'side'
        );
    }

    public function render($post): void
    {
        $this->renderTemplate('post', [
            'post' => $post,
        ]);
    }
}
