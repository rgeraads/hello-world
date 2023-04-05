<?php

declare(strict_types=1);

namespace App\Playground\Author;

final readonly class LastName
{
    public function __construct(private string $lastName)
    {
    }

    public function toString(): string
    {
        return $this->lastName;
    }
}
