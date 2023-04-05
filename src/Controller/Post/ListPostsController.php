<?php

declare(strict_types=1);

namespace App\Controller\Post;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListPostsController
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    #[Route('/posts', methods: ['GET'])]
    public function __invoke(): Response
    {
        $posts = $this->postRepository->findAll();

        return new Response(json_encode(array_map(fn ($row) => $row->toArray(), $posts), JSON_THROW_ON_ERROR), 200);
    }
}
