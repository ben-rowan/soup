<?php declare(strict_types=1);

namespace BenRowan\Soup\Tests\Small\Router;

use BenRowan\Soup\Interfaces\SoupMessageInterface;
use BenRowan\Soup\Soup;
use BenRowan\Soup\SoupMessage;
use BenRowan\Soup\Tests\Assets\Mocks\WasMethodCalled\WasMethodCalledMock;
use BenRowan\Soup\Tests\Assets\Mocks\WasMethodCalled\WasMethodCalledSection;
use PHPUnit\Framework\TestCase;

class CallMethodOnLocalObjectTest extends TestCase
{
    /**
     * @test
     */
    public function wasMethodCalled(): void
    {
        $message = $this->getMessage();

        $message = Soup::call(
            WasMethodCalledMock::getUrn(),
            'method',
            $message
        );

        /** @var WasMethodCalledSection $section */
        $section = $message->getSection(WasMethodCalledSection::getUrn());

        $this->assertTrue($section->getWasMethodCalled());
    }

    private function getMessage(): SoupMessageInterface
    {
        return new SoupMessage();
    }
}