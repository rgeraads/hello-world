<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Playground\User\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final readonly class ListUsersController
{
    public function __construct(private UserRepository $repository)
    {
    }

    #[Route('/users', methods: ['GET'])]
    public function __invoke(): Response
    {
        $users = $this->repository->findAll();

        return new Response(json_encode(array_map(fn (User $user) => $user->toArray(), $users), JSON_THROW_ON_ERROR), 200);
    }
}
