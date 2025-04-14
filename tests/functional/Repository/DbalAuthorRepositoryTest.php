<?php

declare(strict_types=1);

namespace App\Tests\Functional\Repository;

use App\Playground\Author\Author;
use App\Playground\Author\AuthorId;
use App\Playground\Author\FirstName;
use App\Playground\Author\LastName;
use App\Repository\DbalAuthorRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class DbalAuthorRepositoryTest extends KernelTestCase
{
    /** @test */
    public function it_should_save_an_author(): void
    {
        self::bootKernel();

        $authorRepository = static::getContainer()->get(DbalAuthorRepository::class);

        $authorId = AuthorId::generate();

        $author = new Author($authorId, new FirstName('John'), new LastName('Doe'));
        $authorRepository->save($author);

        $author = $authorRepository->findById($authorId->toString());

        self::assertSame($authorId->toString(), $author->getAuthorId()->toString());
        self::assertSame('John', $author->getFirstName()->toString());
        self::assertSame('Doe', $author->getLastName()->toString());
    }
}
