<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\Post;

use App\Playground\Post\Author;
use PHPUnit\Framework\TestCase;

final class AuthorTest extends TestCase
{
    /** @test */
    public function it_should_expose_the_first_name(): void
    {
        $author = new Author('John', 'Doe');

        self::assertSame('John', $author->getFirstName());
    }

    /** @test */
    public function it_should_expose_the_last_name(): void
    {
        $author = new Author('John', 'Doe');

        self::assertSame('Doe', $author->getLastName());
    }

    /** @test */
    public function it_should_expose_the_full_name(): void
    {
        $author = new Author('John', 'Doe');

        self::assertSame('John Doe', $author->getFullName());
    }
}
