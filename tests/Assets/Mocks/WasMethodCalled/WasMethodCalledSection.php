<?php declare(strict_types=1);

namespace BenRowan\Soup\Tests\Assets\Mocks\WasMethodCalled;

use BenRowan\Soup\Interfaces\SoupSectionInterface;

class WasMethodCalledSection implements SoupSectionInterface
{
    private $wasMethodCalled;

    public static function getUrn(): string
    {
        return self::class;
    }

    public function __construct(bool $wasMethodCalled)
    {
        $this->wasMethodCalled = $wasMethodCalled;
    }

    public function getWasMethodCalled(): bool
    {
        return $this->wasMethodCalled;
    }
}