<?php declare(strict_types=1);

namespace BenRowan\Soup;

use BenRowan\Soup\Interfaces\SoupRouterInterface;
use BenRowan\Soup\Interfaces\SoupMessageInterface;
use BenRowan\Soup\Tests\Assets\Mocks\WasMethodCalled\WasMethodCalledMock;

class Soup implements SoupRouterInterface
{
    private const OBJECT = 'object';
    private const OBJECT_LOCATION = 'object_location';
    private const OBJECT_METHODS = 'object_methods';

    private static $resourceLookup;

    public static function init(): void
    {
        if (null !== self::$resourceLookup) {
            return;
        }

        self::$resourceLookup[self::OBJECT][WasMethodCalledMock::getUrn()] = [
            self::OBJECT_LOCATION => WasMethodCalledMock::class,
            self::OBJECT_METHODS => [
                'method'
            ]
        ];
    }

    public static function call(string $universalResourceName, string $methodName, SoupMessageInterface $message): SoupMessageInterface
    {
        self::init(); // This will do for now

        self::assertObjectIsSet($universalResourceName);
        self::assertObjectHasMethod($universalResourceName, $methodName);

        /*
         * This will do for now
         */

        $location      = self::$resourceLookup[self::OBJECT][$universalResourceName][self::OBJECT_LOCATION];
        $returnMessage = forward_static_call([$location, $methodName], $message);

        self::assertMethodCallWasSuccessful($returnMessage);

        return $returnMessage;
    }

    private static function assertObjectIsSet(string $universalResourceName): void
    {
        if (true === isset(self::$resourceLookup[self::OBJECT][$universalResourceName])) {
            return;
        }

        /*
         * This will be handled better in future!
         */

        throw new \RuntimeException(
            "Trying to call a method on un-configured URN '$universalResourceName'"
        );
    }

    private static function assertObjectHasMethod(string $universalResourceName, string $methodName): void
    {
        $methods = self::$resourceLookup[self::OBJECT][$universalResourceName][self::OBJECT_METHODS];

        if (true === in_array($methodName, $methods)) {
            return;
        }

        /*
         * This will be handled better in the future!
         */

        throw new \RuntimeException(
            "Trying to call non-existent method '$methodName' on object '$universalResourceName'"
        );
    }

    private static function assertMethodCallWasSuccessful($returnMessage): void
    {
        if ($returnMessage instanceof SoupMessageInterface) {
            return;
        }

        /*
         * This needs to be MASSIVELY improved
         */

        throw new \RuntimeException(
            "An error occurred calling an object method"
        );
    }
}