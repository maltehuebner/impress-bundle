<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use MalteHuebner\ImpressBundle\Model\ImpressModel;

interface ImpressFactoryInterface
{
    public function getImpress(): ImpressModel;
}
