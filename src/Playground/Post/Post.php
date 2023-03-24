<?php

declare(strict_types=1);

namespace App\Playground\Post;

use DateTime;

final readonly class Post
{
    public function __construct(
        public PostId $postId,
        public Title $title,
        public Author $author,
        public Body $body,
        public Status $status,
        public DateTime $publishedAt,
    ) {
    }
}
