<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\Post;

use App\Playground\Post\PostId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class PostIdTest extends TestCase
{
    /** @test */
    public function it_should_expose_its_post_id(): void
    {
        $uuid = '4a51a7dd-7b29-4e8e-b53c-ba7c4de10be8';

        $postId = PostId::fromString($uuid);

        self::assertSame($uuid, $postId->toString());
    }

    /** @test */
    public function it_should_return_true_if_the_uuid_is_the_same(): void
    {
        $uuid = '4a51a7dd-7b29-4e8e-b53c-ba7c4de10be8';

        $postId = PostId::fromString($uuid);

        self::assertTrue($postId->equals(Uuid::fromString($uuid)));
        self::assertFalse($postId->equals(Uuid::uuid4()));
    }
}
