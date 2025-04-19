<?php

namespace Spichka\Usl;

class Handler
{
    public static function registerRewriteRules(): void
    {
        add_rewrite_rule('^s/([^/]+)/([^/]+)/?', 'index.php?shortlink=$matches[1]&code=$matches[2]', 'top');
        add_rewrite_tag('%shortlink%', '([^&]+)');
        add_rewrite_tag('%code%', '([^&]+)');
    }

    public static function handleRedirect(): void
    {
        if (get_query_var('shortlink') && get_query_var('code')) {
            $shortlink = get_query_var('shortlink');
            $code      = get_query_var('code');

            $redirectUrl = self::resolveShortlink($shortlink, $code);
            if ($redirectUrl) {
                wp_redirect($redirectUrl);
                exit;
            }
        }
    }

    private static function resolveShortlink(string $shortlink, string $code): string
    {
        $utmParams = [
            'utm_source' => $code === 'tg' ? 'telegram' : $code,
        ];

        return home_url("/$shortlink") . '?' . http_build_query($utmParams);
    }
}
