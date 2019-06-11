<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\ImpressFactory;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
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
            'street' => 'Niebuhrstraße',
            'house_number' => '48',
            'zip_code' => '24118',
            'city' => 'Kiel',
            'country' => 'Deutschland',
            'phone_number' => '0049 151 172 77 032',
            'email_address' => 'maltehuebner@gmx.org',
        ]);

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

        $actualImpress = $factory->getImpress();

        $this->assertEquals($expectedImpress, $actualImpress);
    }
}