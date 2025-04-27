<?php

namespace Spichka\Usl\Models;

/**
 * Container with UTM Tracking Links
 */
readonly class SettingContainer
{
    /**
     * @param Utm[] $utms
     * @param Link[] $links
     */
    public function __construct(
        public array $utms,
        public array $links,
    ) {
    }
}
