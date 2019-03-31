<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;

class RemoteJsonFactory extends AbstractImpressFactory
{
    /** @var string $remoteUrl */
    protected $remoteUrl;

    /** @var SerializerInterface $serializer */
    protected $serializer;

    /** @var bool $loaded */
    protected $loaded = false;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;

        parent::__construct();
    }

    public function setRemoteUrl(string $remoteUrl): void
    {
        $this->remoteUrl = $remoteUrl;
    }

    public function getImpress(): ImpressModel
    {
        if (!$this->loaded) {
            $this->impressModel = $this->serializer->deserialize($this->getJsonData(), ImpressModel::class, 'json');

            $this->loaded = true;
        }

        return parent::getImpress();
    }

    protected function getJsonData(): string
    {
        $client = new Client();

        $response = $client->get($this->remoteUrl);

        return $response->getBody()->getContents();
    }
}