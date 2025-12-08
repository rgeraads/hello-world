<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Playground\User\FirstName;
use App\Playground\User\LastName;
use App\Playground\User\User;
use App\Playground\User\UserId;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final readonly class AddUserController
{
    public function __construct(private UserRepository $repository)
    {
    }

    #[Route('/user', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $user = new User(
            UserId::generate(),
            new FirstName($request->getPayload()->get('firstName')),
            new LastName($request->getPayload()->get('lastName')),
        );

        $this->repository->save($user);

        return new Response('', 201);
    }
}
