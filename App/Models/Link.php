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

    public function getLinkToUtm(Utm $utm): LinkToUtm
    {
        foreach ($this->linkToUtms as $linkToUtm) {
            if ($linkToUtm->utm === $utm) {
                return $linkToUtm;
            }
        }

        return new LinkToUtm($utm, '');
    }
}
