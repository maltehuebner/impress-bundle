<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\ImpressFactory;

class ConfigurationImpressFactory extends AbstractImpressFactory
{
    public function setDefaultValues(array $defaultValues): void
    {
        $this->impressModel
            ->setFirstName((string) $defaultValues['first_name'])
            ->setLastName((string) $defaultValues['last_name'])
            ->setStreet((string) $defaultValues['street'])
            ->setHouseNumber((string) $defaultValues['house_number'])
            ->setZipCode((string) $defaultValues['zip_code'])
            ->setCity((string) $defaultValues['city'])
            ->setCountry((string) $defaultValues['country'])
            ->setPhoneNumber((string) $defaultValues['phone_number'])
            ->setEmailAddress((string) $defaultValues['email_address']);
    }
}