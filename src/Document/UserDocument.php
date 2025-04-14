<?php

declare(strict_types=1);

namespace App\Document;

use App\Playground\User\FirstName;
use App\Playground\User\LastName;
use App\Playground\User\User;
use App\Playground\User\UserId;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

#[Document]
readonly class UserDocument
{
    #[Id(type: 'string', strategy: 'NONE')]
    public string $id;

    #[Field(type: 'string')]
    public string $firstName;

    #[Field(type: 'string')]
    public string $lastName;

    private function __construct(string $id, string $firstName, string $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function toUser(): User
    {
        return new User(
            UserId::fromString($this->id),
            new FirstName($this->firstName),
            new LastName($this->lastName)
        );
    }

    public static function fromUser(User $user): self
    {
        return new self(
            $user->userId->toString(),
            $user->firstName->toString(),
            $user->lastName->toString()
        );
    }
}
