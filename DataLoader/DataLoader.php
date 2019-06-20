<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\DataLoader;

use GuzzleHttp\Client;

class DataLoader implements DataLoaderInterface
{
    public function loadJson(string $url): string
    {
        $client = new Client();

        $response = $client->get($this->remoteUrl);

        return $response->getBody()->getContents();
    }
}