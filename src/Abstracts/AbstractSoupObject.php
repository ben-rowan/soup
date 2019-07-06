<?php declare(strict_types=1);

namespace BenRowan\Soup\Abstracts;

use BenRowan\Soup\Interfaces\SoupObjectInterface;
use BenRowan\Soup\Interfaces\SoupRouterInterface;

abstract class AbstractSoupObject implements SoupObjectInterface
{
    private $router;

    public function __construct(SoupRouterInterface $router)
    {
        $this->router = $router;
    }

    protected function getRouter(): SoupRouterInterface
    {
        return $this->router;
    }
}