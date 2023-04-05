<?php

declare(strict_types=1);

namespace App\Playground\Author;

final readonly class Author
{
    public function __construct(private AuthorId $authorId, private FirstName $firstName, private LastName $lastName)
    {
    }

    public function getAuthorId(): AuthorId
    {
        return $this->authorId;
    }

    public function getFirstName(): FirstName
    {
        return $this->firstName;
    }

    public function getLastName(): LastName
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return $this->firstName->toString() . ' ' . $this->lastName->toString();
    }

    /**
     * @param array<string,string> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            AuthorId::fromString($data['id']),
            new FirstName($data['first_name']),
            new LastName($data['last_name'])
        );
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->authorId->toString(),
            'first_name' => $this->firstName->toString(),
            'last_name' => $this->lastName->toString(),
        ];
    }
}
