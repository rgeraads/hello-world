<?php

declare(strict_types=1);

namespace App\Tests\Functional\Repository;

use App\Playground\Author\AuthorId;
use App\Playground\Post\Body;
use App\Playground\Post\Post;
use App\Playground\Post\PostId;
use App\Playground\Post\Status;
use App\Playground\Post\Title;
use App\Repository\DbalPostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class DbalPostRepositoryTest extends KernelTestCase
{
    /** @test */
    public function it_should_save_a_post(): void
    {
        self::bootKernel();

        $postRepository = self::$kernel->getContainer()->get(DbalPostRepository::class);

        $postId = PostId::generate();
        $authorId = AuthorId::generate();

        $post = new Post(
            $postId,
            new Title('Example Post'),
            $authorId,
            new Body('This is an example post'),
            Status::DRAFT,
            new DateTime('2023-03-24 13:48:37')
        );

        $postRepository->save($post);

        $post = $postRepository->findById($postId->toString());

        self::assertSame('Example Post', $post->title->toString());
    }
}
