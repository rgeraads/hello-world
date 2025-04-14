<?php

declare(strict_types=1);

namespace App\Playground\User;

final readonly class FirstName
{
    public function __construct(private string $firstName)
    {
    }

    public function toString(): string
    {
        return $this->firstName;
    }
}
