<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ImpressExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('impress', [$this, 'impress']),
        ];
    }

    public function impress(string $key): ?string
    {
        return 'foobar';
    }
}
