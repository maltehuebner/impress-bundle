<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\DataLoader;

interface DataLoaderInterface
{
    public function loadJson(string $url): string;
}