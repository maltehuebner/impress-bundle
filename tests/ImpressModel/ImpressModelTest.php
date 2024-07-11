<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\ImpressModel;

use MalteHuebner\ImpressBundle\Model\ImpressModel;
use PHPUnit\Framework\TestCase;

class ImpressModelTest extends TestCase
{
    public function testFirstname(): void
    {
        $impress = new ImpressModel();

        $impress->setFirstName('Malte');

        $this->assertEquals('Malte', $impress->getFirstName());
    }

    public function testLastname(): void
    {
        $impress = new ImpressModel();

        $impress->setLastName('Hübner');

        $this->assertEquals('Hübner', $impress->getLastName());
    }


    public function testStreet(): void
    {
        $impress = new ImpressModel();

        $impress->setStreet('Mühlenaustieg');

        $this->assertEquals('Mühlenaustieg', $impress->getStreet());
    }


    public function testHouseNumber(): void
    {
        $impress = new ImpressModel();

        $impress->setHouseNumber('10');

        $this->assertEquals('10', $impress->getHouseNumber());
    }

    public function testHouseNumberWithChars(): void
    {
        $impress = new ImpressModel();

        $impress->setHouseNumber('42a');

        $this->assertEquals('42a', $impress->getHouseNumber());
    }

    public function testHouseNumberWithLeadingZero(): void
    {
        $impress = new ImpressModel();

        $impress->setHouseNumber('023');

        $this->assertEquals('023', $impress->getHouseNumber());
    }

    public function testZipCode(): void
    {
        $impress = new ImpressModel();

        $impress->setZipCode('22523');

        $this->assertEquals('22523', $impress->getZipCode());
    }

    public function testZipCodeWithChars(): void
    {
        $impress = new ImpressModel();

        $impress->setZipCode('D-24782');

        $this->assertEquals('D-24782', $impress->getZipCode());
    }

    public function testZipCodeWithLeadingZero(): void
    {
        $impress = new ImpressModel();

        $impress->setZipCode('01234');

        $this->assertEquals('01234', $impress->getZipCode());
    }

    public function testShortZipCode(): void
    {
        $impress = new ImpressModel();

        $impress->setZipCode('567');

        $this->assertEquals('567', $impress->getZipCode());
    }

    public function testLongZipCode(): void
    {
        $impress = new ImpressModel();

        $impress->setZipCode('890123');

        $this->assertEquals('890123', $impress->getZipCode());
    }

    public function testCity(): void
    {
        $impress = new ImpressModel();

        $impress->setCity('Hamburg');

        $this->assertEquals('Hamburg', $impress->getCity());
    }

    public function testCountry(): void
    {
        $impress = new ImpressModel();

        $impress->setCountry('Deutschland');

        $this->assertEquals('Deutschland', $impress->getCountry());
    }

    public function testEmail(): void
    {
        $impress = new ImpressModel();

        $impress->setEmailAddress('maltehuebner@gmx.org');

        $this->assertEquals('maltehuebner@gmx.org', $impress->getEmailAddress());
    }

    public function testObfuscatedEmail(): void
    {
        $impress = new ImpressModel();

        $impress->setEmailAddress('maltehuebner (at) gmx PUNKT org');

        $this->assertEquals('maltehuebner (at) gmx PUNKT org', $impress->getEmailAddress());
    }

    public function testPhoneNumber(): void
    {
        $impress = new ImpressModel();

        $impress->setPhoneNumber('700864833');

        $this->assertEquals('700864833', $impress->getPhoneNumber());
    }

    public function testPhoneNumberWithLeadingZero(): void
    {
        $impress = new ImpressModel();

        $impress->setPhoneNumber('0700864833');

        $this->assertEquals('0700864833', $impress->getPhoneNumber());
    }

    public function testPhoneNumberWithChars(): void
    {
        $impress = new ImpressModel();

        $impress->setPhoneNumber('+49 700 864 833');

        $this->assertEquals('+49 700 864 833', $impress->getPhoneNumber());
    }
}
