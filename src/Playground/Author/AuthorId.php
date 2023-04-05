<?php

declare(strict_types=1);

namespace App\Playground\Author;

use App\Id;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final readonly class AuthorId implements Id
{
    private function __construct(private UuidInterface $uuid)
    {
    }

    public function equals(UuidInterface $uuid): bool
    {
        return $this->uuid->equals($uuid);
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $uuid): self
    {
        return new self(Uuid::fromString($uuid));
    }
}
