<?php

declare(strict_types=1);

namespace App\Playground\Post;

final readonly class Title
{
    public function __construct(private string $title)
    {
    }

    public function toString(): string
    {
        return $this->title;
    }
}
