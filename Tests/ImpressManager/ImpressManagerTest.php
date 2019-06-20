<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\ImpressManager;

use MalteHuebner\ImpressBundle\Exception\NoImpressFactoryException;
use MalteHuebner\ImpressBundle\ImpressFactory\ImpressFactoryInterface;
use MalteHuebner\ImpressBundle\ImpressManager\ImpressManager;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use PHPUnit\Framework\TestCase;

class ImpressManagerTest extends TestCase
{
    public function testMissingImpressFactory(): void
    {
        $impressManager = new ImpressManager();

        $this->expectException(NoImpressFactoryException::class);

        $actualImpress = $impressManager->getImpress();
    }

    public function testImpress(): void
    {
        $expectedImpress = new ImpressModel();
        $expectedImpress
            ->setFirstName('Malte')
            ->setLastName('Hübner')
            ->setStreet('Mühlenaustieg')
            ->setHouseNumber('10')
            ->setZipCode('22523')
            ->setCity('Hamburg')
            ->setCountry('Deutschland')
            ->setPhoneNumber('0049 700 864 833')
            ->setEmailAddress('maltehuebner@gmx.org');

        $impressFactory = $this->createMock(ImpressFactoryInterface::class);

        $impressManager = new ImpressManager();
        $impressManager->setFactory($impressFactory);

        $impressFactory
            ->expects($this->once())
            ->method('getImpress')
            ->will($this->returnValue($expectedImpress));

        $actualImpress = $impressManager->getImpress();

        $this->assertEquals($expectedImpress, $actualImpress);
    }
}
