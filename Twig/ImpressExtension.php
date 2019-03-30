<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Twig;

use MalteHuebner\ImpressBundle\ImpressManager\ImpressManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ImpressExtension extends AbstractExtension
{
    /** @var ImpressManagerInterface $impressManager */
    protected $impressManager;

    public function __construct(ImpressManagerInterface $impressManager)
    {
        $this->impressManager = $impressManager;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('impress_property', [$this, 'impressProperty']),
        ];
    }

    public function impressProperty(string $propertyName): ?string
    {
        $getMethodName = sprintf('get%s', ucfirst($propertyName));

        return $this->impressManager->getImpress()->$getMethodName();
    }
}
