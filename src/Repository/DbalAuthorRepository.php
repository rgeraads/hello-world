<?php

declare(strict_types=1);

namespace App\Repository;

use App\Playground\Author\Author;
use Doctrine\DBAL\Connection;

final class DbalAuthorRepository implements AuthorRepository
{
    public function __construct(private Connection $connection)
    {
    }

    public function findById(string $id): ?Author
    {
        $result = $this->connection->fetchAssociative('SELECT * FROM author WHERE id = :id', ['id' => $id]);

        if ($result === false) {
            return null;
        }

        return Author::fromArray($result);
    }

    public function save(Author $author): void
    {
        $this->connection->insert('author', $author->toArray());
    }
}
