<?php

declare(strict_types=1);

namespace App\Controller\Author;

use App\Playground\Author\Author;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final readonly class ListAuthorsController
{
    public function __construct(private AuthorRepository $repository)
    {
    }

    #[Route('/authors', methods: ['GET'])]
    public function __invoke(): Response
    {
        $authors = $this->repository->findAll();

        return new Response(json_encode(array_map(fn (Author $author) => $author->toArray(), $authors), JSON_THROW_ON_ERROR), 200);
    }
}
