<?php

declare(strict_types=1);

namespace App;

use Ramsey\Uuid\UuidInterface;

interface Id
{
    public function equals(UuidInterface $uuid): bool;

    public function toString(): string;

    public static function generate(): Id;

    public static function fromString(string $uuid): self;
}
