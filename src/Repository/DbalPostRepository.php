<?php

declare(strict_types=1);

namespace App\Repository;

use App\Playground\Post\Post;
use Doctrine\DBAL\Connection;

final class DbalPostRepository implements PostRepository
{
    public function __construct(private Connection $connection)
    {
    }

    public function findById(string $id): ?Post
    {
        $result = $this->connection->fetchAssociative('SELECT * FROM post WHERE id = :id', ['id' => $id]);

        if ($result === false) {
            return null;
        }

        return Post::fromArray($result);
    }

    public function findAll(): array
    {
        $result = $this->connection->fetchAllAssociative('SELECT * FROM post');

        return array_map(fn ($row) => Post::fromArray($row), $result);
    }

    public function save(Post $post): void
    {
        $this->connection->insert('post', $post->toArray());
    }
}
