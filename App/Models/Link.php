<?php

namespace Spichka\Usl\Models;

/**
 * Short link with UTM comparable
 */
class Link
{
    /**
     * @param string $name
     * @param string $code
     * @param LinkToUtm[] $linkToUtms
     */
    public function __construct(
        private readonly string $code,
        private string $name,
        private array $linkToUtms,
    ) {
    }

    public function getLinkToUtm(Utm $utm): LinkToUtm
    {
        foreach ($this->getLinkToUtms() as $linkToUtm) {
            if ($linkToUtm->getUtm() === $utm) {
                return $linkToUtm;
            }
        }

        return new LinkToUtm($utm, '');
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

    /**
     * @return LinkToUtm[]
     */
    public function getLinkToUtms(): array
    {
        return $this->linkToUtms;
    }

    public function setLinkToUtms(array $linkToUtms): void
    {
        $this->linkToUtms = $linkToUtms;
    }
}
