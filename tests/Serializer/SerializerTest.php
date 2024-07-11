<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Tests\Serializer;

use MalteHuebner\ImpressBundle\Model\ImpressModel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerTest extends TestCase
{
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

    public function testSerializer(): void
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

        $normalizers = [
            new ObjectNormalizer(),
        ];

        $encoders = [
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers, $encoders);
        $actualImpress = $serializer->deserialize(self::TEST_JSON, ImpressModel::class, 'json');

        $this->assertEquals($expectedImpress, $actualImpress);
    }
}
