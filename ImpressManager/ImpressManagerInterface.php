<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressManager;

use MalteHuebner\ImpressBundle\Model\ImpressModel;

interface ImpressManagerInterface
{
    public function getImpress(): ImpressModel;
}