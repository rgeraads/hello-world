<?php

declare(strict_types=1);

namespace App\Controller\Author;

use App\Playground\Author\Author;
use App\Playground\Author\AuthorId;
use App\Playground\Author\FirstName;
use App\Playground\Author\LastName;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final readonly class AddAuthorController
{
    public function __construct(private AuthorRepository $repository)
    {
    }

    #[Route('/author', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $author = new Author(
            AuthorId::generate(),
            new FirstName($request->get('firstName')),
            new LastName($request->get('lastName')),
        );

        $this->repository->save($author);

        return new Response('', 201);
    }
}
