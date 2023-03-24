<?php

declare(strict_types=1);

namespace App\Playground\Post;

final readonly class Body
{
    public function __construct(private string $body)
    {
    }

    public function toString(): string
    {
        return $this->body;
    }
}
