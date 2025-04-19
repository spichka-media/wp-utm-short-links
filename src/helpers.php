<?php

namespace Spichka\UtmShortlinks;

/**
 * Generate UTM-link.
 */
function generateUtmLink($baseUrl, $params) {
    return $baseUrl . '?' . http_build_query($params);
}
