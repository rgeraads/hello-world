<?php

declare(strict_types=1);

namespace App\Tests\Functional\Repository;

use App\Playground\User\FirstName;
use App\Playground\User\LastName;
use App\Playground\User\User;
use App\Playground\User\UserId;
use App\Repository\MongoUserRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class MongoUserRepositoryTest extends KernelTestCase
{
    /** @test */
    public function it_should_save_a_user(): void
    {
        self::bootKernel();

        /** @var UserRepository $userRepository */
        $userRepository = self::$kernel->getContainer()->get(MongoUserRepository::class);

        $userId = UserId::generate();

        $user = new User(
            $userId,
            new FirstName('John'),
            new LastName('Doe'),
        );

        $userRepository->save($user);

        $user = $userRepository->findById($userId->toString());

        self::assertSame('John Doe', $user->getFullName());
    }
}
