<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressManager;

use MalteHuebner\ImpressBundle\ImpressFactory\ImpressFactoryInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;

class ImpressManager implements ImpressManagerInterface
{
    /** @var ImpressFactoryInterface $factory */
    protected $factory;

    public function __construct(ImpressFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function getImpress(): ImpressModel
    {
        return $this->factory->getImpress();
    }
}