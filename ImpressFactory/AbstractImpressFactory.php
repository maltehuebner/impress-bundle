<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use MalteHuebner\ImpressBundle\Model\ImpressModel;

abstract class AbstractImpressFactory implements ImpressFactoryInterface
{
    /** @var ImpressModel $impressModel */
    protected $impressModel;

    public function __construct()
    {
        $this->impressModel = new ImpressModel();
    }

    public function getImpress(): ImpressModel
    {
        return $this->impressModel;
    }
}