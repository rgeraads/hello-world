<?php

declare(strict_types=1);

namespace App\Repository;

use App\Playground\Post\Post;

interface PostRepository
{
    public function findById(string $id): ?Post;

    /**
     * @return Post[]
     */
    public function findAll(): array;

    public function save(Post $post): void;
}
