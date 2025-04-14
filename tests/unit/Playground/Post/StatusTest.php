<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\Post;

use App\Playground\Post\Status;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StatusTest extends TestCase
{
    #[Test]
    public function it_should_expose_its_status(): void
    {
        self::assertSame('draft', Status::DRAFT->value);
        self::assertSame('published', Status::PUBLISHED->value);
        self::assertSame('archived', Status::ARCHIVED->value);
    }
}
