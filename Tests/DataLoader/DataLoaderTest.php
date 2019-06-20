<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\DataLoader;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use MalteHuebner\ImpressBundle\DataLoader\DataLoader;
use PHPUnit\Framework\TestCase;

class DataLoaderTest extends TestCase
{
    public function testGuzzleGet(): void
    {
        $response = new Response();
        $client = $this->createMock(Client::class);

        $client
            ->expects($this->once())
            ->method('__call')
            ->withConsecutive($this->equalTo('get'), $this->equalTo('testurl.json'))
            ->will($this->returnValue($response));

        $dataLoader = new DataLoader($client);

        $dataLoader->loadJson('testurl.json');
    }
}