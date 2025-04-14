<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\User;

use App\Playground\User\FirstName;
use App\Playground\User\LastName;
use App\Playground\User\User;
use App\Playground\User\UserId;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    #[Test]
    public function it_should_expose_the_id(): void
    {
        $userId = UserId::generate();

        $user = new User($userId, new FirstName('John'), new LastName('Doe'));

        self::assertSame($userId->toString(), $user->userId->toString());
    }

    #[Test]
    public function it_should_expose_the_first_name(): void
    {
        $user = new User(UserId::generate(), new FirstName('John'), new LastName('Doe'));

        self::assertSame('John', $user->firstName->toString());
    }

    #[Test]
    public function it_should_expose_the_last_name(): void
    {
        $user = new User(UserId::generate(), new FirstName('John'), new LastName('Doe'));

        self::assertSame('Doe', $user->lastName->toString());
    }

    #[Test]
    public function it_should_expose_the_full_name(): void
    {
        $user = new User(UserId::generate(), new FirstName('John'), new LastName('Doe'));

        self::assertSame('John Doe', $user->getFullName());
    }
}
