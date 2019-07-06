<?php declare(strict_types=1);

namespace BenRowan\Soup\Interfaces;

interface SoupObjectInterface
{
    public function __construct(SoupRouterInterface $router);

    public static function getUrn(): string;
}