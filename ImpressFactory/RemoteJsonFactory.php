<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class RemoteJsonFactory extends AbstractCachingImpressFactory
{
    /** @var string $remoteUrl */
    protected $remoteUrl;

    /** @var bool $loaded */
    protected $loaded = false;

    public function setRemoteUrl(string $remoteUrl): void
    {
        $this->remoteUrl = $remoteUrl;
    }

    protected function generateImpress(): ImpressModel
    {
        $this->impressModel = $this->getSerializer()->deserialize($this->getJsonData(), ImpressModel::class, 'json');

        return $this->impressModel;
    }

    protected function getJsonData(): string
    {
        $client = new Client();

        $response = $client->get($this->remoteUrl);

        return $response->getBody()->getContents();
    }

    protected function getSerializer(): SerializerInterface
    {
        return JMS\Serializer\SerializerBuilder::create()->build();
    }
}