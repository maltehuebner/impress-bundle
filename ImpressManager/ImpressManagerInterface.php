<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressManager;

use MalteHuebner\ImpressBundle\ImpressFactory\ImpressFactoryInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;

interface ImpressManagerInterface
{
    public function setFactory(ImpressFactoryInterface $factory): void;

    public function getImpress(): ImpressModel;
}