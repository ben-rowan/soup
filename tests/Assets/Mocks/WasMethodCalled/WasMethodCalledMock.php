<?php declare(strict_types=1);

namespace BenRowan\Soup\Tests\Assets\Mocks\WasMethodCalled;

use BenRowan\Soup\Abstracts\AbstractSoupObject;
use BenRowan\Soup\Interfaces\SoupMessageInterface;

class WasMethodCalledMock extends AbstractSoupObject
{
    public static function getUrn(): string
    {
        return self::class;
    }

    public static function method(SoupMessageInterface $message): SoupMessageInterface
    {
        $section = new WasMethodCalledSection(true);

        $message->addSection($section);

        return $message;
    }
}