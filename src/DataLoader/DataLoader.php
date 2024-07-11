<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\DataLoader;

class DataLoader implements DataLoaderInterface
{
    public function loadJson(string $url): string
    {
        return file_get_contents($url);
    }
}
