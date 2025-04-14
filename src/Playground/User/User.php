<?php

declare(strict_types=1);

namespace App\Playground\User;

final readonly class User
{
    public function __construct(
        public UserId $userId,
        public FirstName $firstName,
        public LastName $lastName,
    ) {
    }

    public function getFullName(): string
    {
        return $this->firstName->toString() . ' ' . $this->lastName->toString();
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->userId->toString(),
            'firstName' => $this->firstName->toString(),
            'lastName' => $this->lastName->toString(),
        ];
    }
}
