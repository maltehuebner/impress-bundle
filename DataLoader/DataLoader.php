<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\DataLoader;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class DataLoader implements DataLoaderInterface
{
    /** @var ClientInterface $client */
    protected $client;

    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function loadJson(string $url): string
    {
        $response = $this->client->get($url);

        return $response->getBody()->getContents();
    }
}