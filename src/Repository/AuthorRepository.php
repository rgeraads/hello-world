<?php

declare(strict_types=1);

namespace App\Repository;

use App\Playground\Author\Author;

interface AuthorRepository
{
    public function findById(string $id): ?Author;

    /**
     * @return Author[]
     */
    public function findAll(): array;

    public function save(Author $author): void;
}
