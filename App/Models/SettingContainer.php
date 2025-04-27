<?php

namespace Spichka\Usl\Models;

use InvalidArgumentException;

/**
 * Container with UTM Tracking Links
 */
class SettingContainer
{
    /**
     * @param Utm[] $utms
     * @param Link[] $links
     */
    public function __construct(
        private array $utms,
        private array $links,
    ) {
    }

    public function getUtms(): array
    {
        return $this->utms;
    }

    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param array<int, string> $names
     * @param array<int, string> $codes
     * @return void
     */
    public function updateUtms(array $names, array $codes): void
    {
        if (count($names) !== count($codes)) {
            throw new InvalidArgumentException('Names and codes arrays must have the same length');
        }

        foreach ($names as $index => $name) {
            if (!$name) {
                continue;
            }

            $code = $codes[$index] ?? '';
            if (!$code) {
                continue;
            }

            $isUtmExists = false;
            foreach ($this->utms as $utm) {
                if ($utm->getCode() === $code) {
                    $utm->setName($name);
                    $isUtmExists = true;
                    break;
                }
            }
            if (!$isUtmExists) {
                $newUtm = new Utm($name, $code);
                $this->utms[] = $newUtm;
            }
        }

        foreach ($this->utms as $utmIndex => $utm) {
            if (!in_array($utm->getCode(), $codes, true)) {
                unset($this->utms[$utmIndex]);
            }
        }

        foreach ($this->links as $link) {
            $linkToUtms = $link->getLinkToUtms();
            foreach ($linkToUtms as $linkToUtmIndex => $linkToUtm) {
                if (!in_array($linkToUtm->getUtm()->getCode(), $codes, true)) {
                    unset($linkToUtms[$linkToUtmIndex]);
                }
            }
            $link->setLinkToUtms($linkToUtms);
        }
    }

    /**
     * @param array<int, string> $names
     * @param array<int, string> $codes
     * @param array<string, array<int, string>> $linkToUtms
     * @return void
     */
    public function updateLinks(array $names, array $codes, array $linkToUtms): void
    {
        if (count($names) !== count($codes)) {
            throw new InvalidArgumentException('Names and codes arrays must have the same length');
        }

        $newLinks = [];
        foreach ($names as $index => $name) {
            if (!$name) {
                continue;
            }

            $code = $codes[$index] ?? '';
            if (!$code) {
                continue;
            }

            $newLinksToUtms = [];
            foreach ($this->utms as $utm) {
                $newLinksToUtmValue = $linkToUtms[$utm->getCode()][$index] ?? '';
                $newLinksToUtm = new LinkToUtm($utm, $newLinksToUtmValue);
                $newLinksToUtms[] = $newLinksToUtm;
            }

            $newLinks[] = new Link($code, $name, $newLinksToUtms);
        }

        $this->links = $newLinks;
    }
}
