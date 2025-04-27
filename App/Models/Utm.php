<?php

namespace Spichka\Usl\Models;

/**
 * Used UTM Tracking Links
 */
readonly class Utm
{
    public function __construct(
        public string $code,
        public string $name,
    ) {
    }
}
