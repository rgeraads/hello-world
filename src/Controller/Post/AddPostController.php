<?php

declare(strict_types=1);

namespace App\Controller\Post;

use App\Playground\Author\AuthorId;
use App\Playground\Post\Body;
use App\Playground\Post\Post;
use App\Playground\Post\PostId;
use App\Playground\Post\Status;
use App\Playground\Post\Title;
use App\Repository\PostRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final readonly class AddPostController
{
    public function __construct(private PostRepository $repository)
    {
    }

    #[Route('/post', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $post = new Post(
            PostId::generate(),
            new Title($request->get('title')),
            AuthorId::fromString($request->get('author_id')),
            new Body($request->get('body')),
            Status::PUBLISHED,
            new DateTime(),
        );

        $this->repository->save($post);

        return new Response('', 201);
    }
}
