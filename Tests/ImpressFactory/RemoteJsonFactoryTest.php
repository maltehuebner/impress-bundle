<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\ImpressFactory;

use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use MalteHuebner\ImpressBundle\DataLoader\DataLoaderInterface;
use MalteHuebner\ImpressBundle\ImpressFactory\ConfigurationImpressFactory;
use MalteHuebner\ImpressBundle\ImpressFactory\RemoteJsonFactory;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\CacheItem;
use Symfony\Contracts\Cache\ItemInterface;

class RemoteJsonFactoryTest extends TestCase
{
    protected function getTestJsonString(): string
    {
        return '{
    "first_name": "Malte",
    "last_name": "Hübner",
    "street": "Niebuhrstraße",
    "house_number": "48",
    "zip_code": "24118",
    "city": "Kiel",
    "country": "Deutschland",
    "phone_number": "0049 151 172 77 032",
    "email_address": "maltehuebner@gmx.org"
}';
    }

    public function testImpressWithoutCache(): void
    {
        $loader = require __DIR__.'/../../vendor/autoload.php';
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);

        $cacheItemMock = $this->createMock(ItemInterface::class);
        $cacheItemMock->method('isHit')->willReturn(false);
        $cacheItemMock->method('set')->willReturn($cacheItemMock);

        $adapterMock = $this->createMock(AdapterInterface::class);
        $adapterMock->method('getItem')->willReturn($cacheItemMock);

        $dataLoaderMock = $this->createMock(DataLoaderInterface::class);
        $dataLoaderMock
            ->expects($this->once())
            ->method('loadJson')
            ->will($this->returnValue($this->getTestJsonString()));

        $factory = new RemoteJsonFactory($adapterMock, $dataLoaderMock);

        $expectedImpress = new ImpressModel();
        $expectedImpress
            ->setFirstName('Malte')
            ->setLastName('Hübner')
            ->setStreet('Niebuhrstraße')
            ->setHouseNumber('48')
            ->setZipCode('24118')
            ->setCity('Kiel')
            ->setCountry('Deutschland')
            ->setPhoneNumber('0049 151 172 77 032')
            ->setEmailAddress('maltehuebner@gmx.org');

        $actualImpress = $factory->setRemoteUrl('testurl')->getImpress();

        $this->assertEquals($expectedImpress, $actualImpress);
    }
}