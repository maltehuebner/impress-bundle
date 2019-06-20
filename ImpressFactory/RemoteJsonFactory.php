<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializerBuilder;
use MalteHuebner\ImpressBundle\DataLoader\DataLoaderInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class RemoteJsonFactory extends AbstractCachingImpressFactory
{
    /** @var string $remoteUrl */
    protected $remoteUrl;

    /** @var bool $loaded */
    protected $loaded = false;

    /** @var DataLoaderInterface $dataLoader */
    protected $dataLoader;

    public function __construct(AdapterInterface $adapter, DataLoaderInterface $dataLoader)
    {
        $this->dataLoader = $dataLoader;

        parent::__construct($adapter);
    }

    public function setRemoteUrl(string $remoteUrl): RemoteJsonFactory
    {
        $this->remoteUrl = $remoteUrl;

        return $this;
    }

    protected function generateImpress(): ImpressModel
    {
        $jsonData = $this->dataLoader->loadJson($this->remoteUrl);

        $this->impressModel = $this->getSerializer()->deserialize($jsonData, ImpressModel::class, 'json');

        return $this->impressModel;
    }

    protected function getSerializer(): SerializerInterface
    {
        return SerializerBuilder::create()->build();
    }
}