<?php declare(strict_types=1);

namespace BenRowan\Soup\Interfaces;

interface SoupRouterInterface
{
    public static function init(): void;

    public static function call(string $universalResourceName, string $method, SoupMessageInterface $message): SoupMessageInterface;
}