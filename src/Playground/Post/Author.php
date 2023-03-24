<?php

declare(strict_types=1);

namespace App\Playground\Post;

final readonly class Author
{
    public function __construct(private string $firstName, private string $lastName)
    {
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
