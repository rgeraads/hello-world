<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Post;

use App\Playground\Author\AuthorId;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class AddPostControllerTest extends WebTestCase
{
    /** @test */
    public function it_should_add_a_post(): void
    {
        $client = self::createClient();

        $postRepository = self::$kernel->getContainer()->get(PostRepository::class);
        $posts = $postRepository->findAll();

        self::assertCount(0, $posts);

        $authorId = AuthorId::generate()->toString();

        $client->request('POST', '/post', ['title' => 'Randy\'s awesome title', 'body' => 'the body', 'author_id' => $authorId]);

        $response = $client->getResponse();

        self::assertSame(201, $response->getStatusCode());
        self::assertSame('', $response->getContent());

        $posts = $postRepository->findAll();

        self::assertCount(1, $posts);
    }
}
