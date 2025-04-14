<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Post;

use App\Playground\Author\AuthorId;
use App\Playground\Post\Body;
use App\Playground\Post\Post;
use App\Playground\Post\PostId;
use App\Playground\Post\Status;
use App\Playground\Post\Title;
use App\Repository\PostRepository;
use DateTime;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ListPostsControllerTest extends WebTestCase
{
    #[Test]
    public function it_should_list_posts(): void
    {
        $client = self::createClient();

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

        $postRepository = self::$kernel->getContainer()->get(PostRepository::class);
        $postRepository->save($post);

        $client->request('GET', '/posts');

        $response = $client->getResponse();

        $expected = [
            [
                'id' => $postId->toString(),
                'title' => 'Example Post',
                'author_id' => $authorId->toString(),
                'body' => 'This is an example post',
                'status' => 'draft',
                'published_at' => '2023-03-24 13:48:37',
            ],
        ];

        self::assertSame(200, $response->getStatusCode());
        self::assertSame($expected, json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR));
    }
}
