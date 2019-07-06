<?php declare(strict_types=1);

namespace BenRowan\Soup\Interfaces;

interface SoupMessageInterface
{
    public function addSection(SoupSectionInterface $section): void;

    public function getSection(string $universalResourceName): SoupSectionInterface;
}