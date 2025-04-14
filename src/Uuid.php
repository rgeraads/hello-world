<?php

declare(strict_types=1);

namespace App;

use Ramsey\Uuid\UuidInterface;

abstract readonly class Uuid
{
    final private function __construct(private UuidInterface $uuid)
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

    public static function generate(): static
    {
        return new static(\Ramsey\Uuid\Uuid::uuid4());
    }

    public static function fromString(string $uuid): static
    {
        return new static(\Ramsey\Uuid\Uuid::fromString($uuid));
    }
}
