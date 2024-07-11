<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\ImpressFactory;

use MalteHuebner\ImpressBundle\DataLoader\DataLoaderInterface;
use MalteHuebner\ImpressBundle\ImpressFactory\RemoteJsonFactory;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\CacheItem;

class RemoteJsonFactoryTest extends TestCase
{
    private static \Closure $createCacheItem;

    private const string TEST_JSON = '{
    "first_name": "Malte",
    "last_name": "Hübner",
    "street": "Mühlenaustieg",
    "house_number": "10",
    "zip_code": "24118",
    "city": "Hamburg",
    "country": "Deutschland",
    "phone_number": "0049 700 864 833",
    "email_address": "maltehuebner@gmx.org"
}';

    public function setUp(): void
    {
        self::$createCacheItem ??= \Closure::bind(
            static function (string $key, object $value = null, bool $isHit = false, int $expiry = null) {
                $item = new CacheItem();
                $item->key = $key;
                $item->value = $value;
                $item->isHit = $isHit;
                $item->expiry = $expiry;
                $item->unpack();

                return $item;
            },
            null,
            CacheItem::class
        );
    }

    public function testImpressWithCacheMiss(): void
    {
        $expectedImpress = new ImpressModel();
        $expectedImpress
            ->setFirstName('Malte')
            ->setLastName('Hübner')
            ->setStreet('Mühlenaustieg')
            ->setHouseNumber('10')
            ->setZipCode('24118')
            ->setCity('Hamburg')
            ->setCountry('Deutschland')
            ->setPhoneNumber('0049 700 864 833')
            ->setEmailAddress('maltehuebner@gmx.org')
        ;

        $filledCacheItem = (self::$createCacheItem)('foo', $expectedImpress, false, (int) (new \DateTime('+1 hour'))->format('U'));
        $emptyCacheItem = (self::$createCacheItem)('foo');

        $adapterMock = $this->createMock(AdapterInterface::class);
        $adapterMock
            ->expects($this->exactly(2))
            ->method('getItem')
            ->willReturn($emptyCacheItem)
        ;

        $adapterMock
            ->expects($this->once())
            ->method('save')
            ->with($this->equalTo($filledCacheItem))
            ->willReturn(true)
        ;

        $dataLoaderMock = $this->createMock(DataLoaderInterface::class);
        $dataLoaderMock
            ->expects($this->once())
            ->method('loadJson')
            ->willReturn(self::TEST_JSON)
        ;

        $factory = new RemoteJsonFactory($adapterMock, $dataLoaderMock);

        $actualImpress = $factory
            ->setRemoteUrl('testurl')
            ->getImpress()
        ;

        $this->assertEquals($expectedImpress, $actualImpress);
    }

    public function testImpressWithCacheHit(): void
    {
        $expectedImpress = new ImpressModel();
        $expectedImpress
            ->setFirstName('Malte')
            ->setLastName('Hübner')
            ->setStreet('Mühlenaustieg')
            ->setHouseNumber('10')
            ->setZipCode('24118')
            ->setCity('Hamburg')
            ->setCountry('Deutschland')
            ->setPhoneNumber('0049 700 864 833')
            ->setEmailAddress('maltehuebner@gmx.org')
        ;

        $filledCacheItem = (self::$createCacheItem)('foo', $expectedImpress, true, (int) (new \DateTime('+1 hour'))->format('U'));

        $adapterMock = $this->createMock(AdapterInterface::class);
        $adapterMock
            ->expects($this->once())
            ->method('getItem')
            ->willReturn($filledCacheItem)
        ;

        $adapterMock
            ->expects($this->never())
            ->method('save')
        ;

        $dataLoaderMock = $this->createMock(DataLoaderInterface::class);
        $dataLoaderMock
            ->expects($this->never())
            ->method('loadJson')
        ;

        $factory = new RemoteJsonFactory($adapterMock, $dataLoaderMock);

        $actualImpress = $factory
            ->setRemoteUrl('testurl')
            ->getImpress()
        ;

        $this->assertEquals($expectedImpress, $actualImpress);
    }
}
