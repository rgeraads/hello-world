<?php

declare(strict_types=1);

namespace App\Playground\Post;

use App\Playground\Author\AuthorId;
use DateTime;

final readonly class Post
{
    public function __construct(
        public PostId $postId,
        public Title $title,
        public AuthorId $authorId,
        public Body $body,
        public Status $status,
        public DateTime $publishedAt,
    ) {
    }

    /**
     * @param array<string,string> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            PostId::fromString($data['id']),
            new Title($data['title']),
            AuthorId::fromString($data['author_id']),
            new Body($data['body']),
            Status::from($data['status']),
            new DateTime($data['published_at'])
        );
    }

    /**
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->postId->toString(),
            'title' => $this->title->toString(),
            'author_id' => $this->authorId->toString(),
            'body' => $this->body->toString(),
            'status' => $this->status->value,
            'published_at' => $this->publishedAt->format('Y-m-d H:i:s'),
        ];
    }
}
