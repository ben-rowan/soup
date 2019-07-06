<?php declare(strict_types=1);

namespace BenRowan\Soup;

use BenRowan\Soup\Interfaces\SoupMessageInterface;
use BenRowan\Soup\Interfaces\SoupSectionInterface;

class SoupMessage implements SoupMessageInterface
{
    /**
     * @var SoupSectionInterface[]
     */
    private $sections = [];

    public function addSection(SoupSectionInterface $section): void
    {
        $this->assertSectionNotAlreadySet($section);

        $this->sections[$section->getUrn()] = $section;
    }

    public function getSection(string $universalResourceName): SoupSectionInterface
    {
        $this->assertSectionIsAlreadySet($universalResourceName);

        return $this->sections[$universalResourceName];
    }

    private function assertSectionIsAlreadySet(string $universalResourceName): void
    {
        if (true === isset($this->sections[$universalResourceName])) {
            return;
        }

        /*
         * This will be handled better in future!
         */

        throw new \RuntimeException(
            "You're trying to access section '$universalResourceName' which hasn't been set"
        );
    }

    private function assertSectionNotAlreadySet(SoupSectionInterface $section): void
    {
        if (false === isset($this->sections[$section::getUrn()])) {
            return;
        }

        /*
         * This will be handled better in future!
         */

        throw new \RuntimeException(
            "You've already added a section with URN {$section::getUrn()}"
        );
    }
}