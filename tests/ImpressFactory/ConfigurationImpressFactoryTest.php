<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\ImpressFactory;

use MalteHuebner\ImpressBundle\ImpressFactory\ConfigurationImpressFactory;
use MalteHuebner\ImpressBundle\Model\ImpressModel;
use PHPUnit\Framework\TestCase;

class ConfigurationImpressFactoryTest extends TestCase
{
    public function testImpressViaDefaultValuesFromArray(): void
    {
        $factory = new ConfigurationImpressFactory();
        $factory->setDefaultValues([
            'first_name' => 'Malte',
            'last_name' => 'Hübner',
            'street' => 'Mühlenaustieg',
            'house_number' => '10',
            'zip_code' => '24118',
            'city' => 'Hamburg',
            'country' => 'Deutschland',
            'phone_number' => '0049 700 864 833',
            'email_address' => 'maltehuebner@gmx.org',
        ]);

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
            ->setEmailAddress('maltehuebner@gmx.org');

        $actualImpress = $factory->getImpress();

        $this->assertEquals($expectedImpress, $actualImpress);
    }
}
