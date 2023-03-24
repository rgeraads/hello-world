<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\Post;

use App\Playground\Post\Status;
use PHPUnit\Framework\TestCase;

final class StatusTest extends TestCase
{
    /** @test */
    public function it_should_expose_its_status(): void
    {
        self::assertSame('draft', Status::DRAFT->value);
        self::assertSame('published', Status::PUBLISHED->value);
        self::assertSame('archived', Status::ARCHIVED->value);
    }

    /** @test */
    public function it_should_return_null_on_invalid_value(): void
    {
        self::assertNull(Status::tryFrom('foo'));
    }
}
