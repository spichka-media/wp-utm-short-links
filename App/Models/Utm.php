<?php

namespace Spichka\Usl\Models;

/**
 * Used UTM Tracking Links
 */
class Utm
{
    public function __construct(
        private readonly string $code,
        private string $name,
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
