<?php

declare(strict_types=1);

namespace App\Controller\Post;

use App\Playground\Post\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final readonly class ListPostsController
{
    public function __construct(private PostRepository $repository)
    {
    }

    #[Route('/posts', methods: ['GET'])]
    public function __invoke(): Response
    {
        $posts = $this->repository->findAll();

        return new Response(json_encode(array_map(fn (Post $post) => $post->toArray(), $posts), JSON_THROW_ON_ERROR), 200);
    }
}
