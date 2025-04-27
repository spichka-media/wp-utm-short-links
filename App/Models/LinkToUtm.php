<?php

namespace Spichka\Usl\Models;

/**
 * Utm trackings in short link
 */
readonly class LinkToUtm
{
    public function __construct(
        public Utm $utm,
        public string $utmValue,
    ) {
    }
}
