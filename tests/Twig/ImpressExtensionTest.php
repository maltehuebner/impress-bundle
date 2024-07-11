<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\Twig;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use MalteHuebner\ImpressBundle\ImpressFactory\ConfigurationImpressFactory;
use MalteHuebner\ImpressBundle\ImpressManager\ImpressManagerInterface;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use MalteHuebner\ImpressBundle\Twig\ImpressExtension;
use PHPUnit\Framework\TestCase;

class ImpressExtensionTest extends TestCase
{
    public function testImpressProperties(): void
    {
        $impressModel = new ImpressModel();
        $impressModel
            ->setFirstName('Malte')
            ->setLastName('Hübner')
            ->setStreet('Mühlenaustieg')
            ->setHouseNumber('10')
            ->setZipCode('22523')
            ->setCity('Hamburg')
            ->setCountry('Deutschland')
            ->setPhoneNumber('0049 700 864 833')
            ->setEmailAddress('maltehuebner@gmx.org');

        $impressManager = $this->createMock(ImpressManagerInterface::class);
        $impressManager
            ->expects($this->exactly(9))
            ->method('getImpress')
            ->willReturn($impressModel);

        $impressExtension = new ImpressExtension($impressManager);

        $this->assertEquals('Malte', $impressExtension->impressProperty('firstName'));
        $this->assertEquals('Hübner', $impressExtension->impressProperty('lastName'));
        $this->assertEquals('Mühlenaustieg', $impressExtension->impressProperty('street'));
        $this->assertEquals('10', $impressExtension->impressProperty('houseNumber'));
        $this->assertEquals('22523', $impressExtension->impressProperty('zipCode'));
        $this->assertEquals('Hamburg', $impressExtension->impressProperty('city'));
        $this->assertEquals('Deutschland', $impressExtension->impressProperty('country'));
        $this->assertEquals('0049 700 864 833', $impressExtension->impressProperty('phoneNumber'));
        $this->assertEquals('maltehuebner@gmx.org', $impressExtension->impressProperty('emailAddress'));
    }
}
