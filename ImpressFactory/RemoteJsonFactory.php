<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use MalteHuebner\ImpressBundle\DataLoader\DataLoaderInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

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
        $normalizers = [
            new \Symfony\Component\Serializer\Normalizer\ObjectNormalizer(),
        ];

        $encoders = [
            new \Symfony\Component\Serializer\Encoder\JsonEncoder(),
        ];

        return new Serializer($normalizers, $encoders);
    }
}
