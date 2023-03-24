<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\Post;

use App\Playground\Post\Author;
use App\Playground\Post\Body;
use App\Playground\Post\Post;
use App\Playground\Post\PostId;
use App\Playground\Post\Status;
use App\Playground\Post\Title;
use DateTime;
use PHPUnit\Framework\TestCase;

final class PostTest extends TestCase
{
    /** @test */
    public function it_should_create_a_post(): void
    {
        $postId = PostId::generate();

        $post = new Post(
            $postId,
            new Title('Example Post'),
            new Author('Randy', 'Geraads'),
            new Body('This is an example post'),
            Status::DRAFT,
            new DateTime('2023-03-24 13:48:37')
        );

        self::assertSame($postId->toString(), $post->postId->toString());
        self::assertSame('Example Post', $post->title->toString());
        self::assertSame('Randy Geraads', $post->author->getFullName());
        self::assertSame('This is an example post', $post->body->toString());
        self::assertSame(Status::DRAFT, $post->status);
        self::assertSame('2023-03-24 13:48:37', $post->publishedAt->format('Y-m-d H:i:s'));
    }
}
