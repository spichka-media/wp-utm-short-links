<?php

namespace Spichka\Usl\Models;

/**
 * Short link with UTM comparable
 */
readonly class Link
{
    /**
     * @param string $name
     * @param string $code
     * @param LinkToUtm[] $linkToUtms
     */
    public function __construct(
        public string $name,
        public string $code,
        public array $linkToUtms,
    ) {
    }
}
