<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\Post;

use App\Playground\Post\Title;
use PHPUnit\Framework\TestCase;

final class BodyTest extends TestCase
{
    /** @test */
    public function it_should_expose_the_body(): void
    {
        $body = new Title('Test Body');

        self::assertSame('Test Body', $body->toString());
    }
}
