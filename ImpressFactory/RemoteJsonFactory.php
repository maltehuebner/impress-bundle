<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class RemoteJsonFactory extends AbstractCachingImpressFactory
{
    /** @var string $remoteUrl */
    protected $remoteUrl;

    /** @var SerializerInterface $serializer */
    protected $serializer;

    /** @var bool $loaded */
    protected $loaded = false;

    public function __construct(SerializerInterface $serializer, AdapterInterface $adapter)
    {
        $this->serializer = $serializer;

        parent::__construct($adapter);
    }

    public function setRemoteUrl(string $remoteUrl): void
    {
        $this->remoteUrl = $remoteUrl;
    }

    protected function generateImpress(): ImpressModel
    {
        $this->impressModel = $this->serializer->deserialize($this->getJsonData(), ImpressModel::class, 'json');

        return $this->impressModel;
    }

    protected function getJsonData(): string
    {
        $client = new Client();

        $response = $client->get($this->remoteUrl);

        return $response->getBody()->getContents();
    }
}