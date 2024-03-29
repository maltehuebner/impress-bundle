<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializerBuilder;
use MalteHuebner\ImpressBundle\DataLoader\DataLoaderInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use Psr\Cache\CacheItemPoolInterface;

class RemoteJsonFactory extends AbstractCachingImpressFactory
{
    protected string $remoteUrl;

    protected bool $loaded = false;

    protected DataLoaderInterface $dataLoader;

    public function __construct(CacheItemPoolInterface $adapter, DataLoaderInterface $dataLoader)
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
