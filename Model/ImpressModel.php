<?php declare(strict_types=1);

namespace MalteHuebner\ImpressBundle\Model;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @JMS\ExclusionPolicy("all")
 */
class ImpressModel
{
    /**
     * @var string $firstName
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $firstName;

    /**
     * @var string $lastName
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $lastName;

    /**
     * @var string $street
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $street;

    /**
     * @var string $houseNumber
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $houseNumber;

    /**
     * @var string $zipCode
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $zipCode;

    /**
     * @var string $city
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $city;

    /**
     * @var string $country
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $country;

    /**
     * @var string $phoneNumber
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $phoneNumber;

    /**
     * @var string $emailAddress
     * @JMS\Expose
     * @JMS\Type("string")
     */
    protected $emailAddress;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): ImpressModel
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): ImpressModel
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): ImpressModel
    {
        $this->street = $street;

        return $this;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): ImpressModel
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): ImpressModel
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): ImpressModel
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): ImpressModel
    {
        $this->country = $country;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): ImpressModel
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): ImpressModel
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }
}