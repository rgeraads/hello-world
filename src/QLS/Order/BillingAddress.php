<?php

declare(strict_types=1);

namespace App\QLS\Order;

final class BillingAddress
{
    private function __construct(
        private ?string $companyName,
        private string $name,
        private string $street,
        private string $houseNumber,
        private string $addressLine2,
        private string $zipCode,
        private string $city,
        private string $country,
        private string $emailAddress,
        private string $phoneNumber
    ) {
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    public function getAddressLine2(): string
    {
        return $this->addressLine2;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public static function fromData(array $data): self
    {
        return new self(
            $data['companyname'],
            $data['name'],
            $data['street'],
            $data['housenumber'],
            $data['address_line_2'],
            $data['zipcode'],
            $data['city'],
            $data['country'],
            $data['email'],
            $data['phone'],
        );
    }
}
