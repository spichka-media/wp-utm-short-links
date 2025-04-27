<?php

namespace Spichka\Usl\Models;

/**
 * Utm trackings in short link
 */
class LinkToUtm
{
    public function __construct(
        private readonly Utm $utm,
        private string $utmValue,
    ) {
    }

    public function getUtm(): Utm
    {
        return $this->utm;
    }

    public function getUtmValue(): string
    {
        return $this->utmValue;
    }

    public function setUtmValue(string $utmValue): void
    {
        $this->utmValue = $utmValue;
    }
}
