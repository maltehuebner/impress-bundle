<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressManager;

use MalteHuebner\ImpressBundle\Exception\NoImpressFactoryException;
use MalteHuebner\ImpressBundle\ImpressFactory\ImpressFactoryInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;

class ImpressManager implements ImpressManagerInterface
{
    protected ImpressFactoryInterface $factory;

    public function setFactory(ImpressFactoryInterface $factory): void
    {
        $this->factory = $factory;
    }

    public function getImpress(): ImpressModel
    {
        return $this->factory->getImpress();
    }
}
