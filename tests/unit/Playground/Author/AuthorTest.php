<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\Author;

use App\Playground\Author\Author;
use App\Playground\Author\AuthorId;
use App\Playground\Author\FirstName;
use App\Playground\Author\LastName;
use PHPUnit\Framework\TestCase;

final class AuthorTest extends TestCase
{
    /** @test */
    public function it_should_expose_the_id(): void
    {
        $authorId = AuthorId::generate();

        $author = new Author($authorId, new FirstName('John'), new LastName('Doe'));

        self::assertSame($authorId->toString(), $author->getAuthorId()->toString());
    }

    /** @test */
    public function it_should_expose_the_first_name(): void
    {
        $author = new Author(AuthorId::generate(), new FirstName('John'), new LastName('Doe'));

        self::assertSame('John', $author->getFirstName()->toString());
    }

    /** @test */
    public function it_should_expose_the_last_name(): void
    {
        $author = new Author(AuthorId::generate(), new FirstName('John'), new LastName('Doe'));

        self::assertSame('Doe', $author->getLastName()->toString());
    }

    /** @test */
    public function it_should_expose_the_full_name(): void
    {
        $author = new Author(AuthorId::generate(), new FirstName('John'), new LastName('Doe'));

        self::assertSame('John Doe', $author->getFullName());
    }
}
