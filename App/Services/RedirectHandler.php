<?php

namespace Spichka\Usl\Services;

class RedirectHandler
{
    /**
     * @param string $requestUri
     * @return void
     */
    public function handle(string $requestUri): void
    {
        if (!$requestUri) {
            return;
        }

        $query = parse_url($requestUri, PHP_URL_QUERY);
        $requestUri = str_replace("?$query", '', $requestUri);
        if (!$requestUri) {
            return;
        }
        parse_str($query, $query);

        // Разбиваем строку по 1
        $requestUri = explode('/', $requestUri, 3);

        $linkCode = $requestUri[1] ?? '';
        $postName = $requestUri[2] ?? '';
        if (!$linkCode || !$postName) {
            return;
        }
        $postName = urldecode($postName);

        $post = get_page_by_path($postName, OBJECT, 'post');
        if (!$post) {
            return;
        }

        $settingService = new SettingService();
        $settingContainer = $settingService->getContainer();
        foreach ($settingContainer->getLinks() as $link) {
            if ($link->getCode() === $linkCode) {
                foreach ($link->getLinkToUtms() as $utm) {
                    if ($utm->getUtmValue()) {
                        $query[$utm->getUtm()->getCode()] = $utm->getUtmValue();
                    }
                }

                $url = get_permalink($post->ID);
                if (substr($url, -1) === '/') {
                    $url = substr($url, 0, -1);
                }
                $url .= '?' . http_build_query($query);
                wp_redirect($url, 302);
                exit;
            }
        }
    }
}
