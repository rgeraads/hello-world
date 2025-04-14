<?php

declare(strict_types=1);

namespace App\Repository;

use App\Document\UserDocument;
use App\Playground\User\User;
use Doctrine\ODM\MongoDB\DocumentManager;

final class MongoUserRepository implements UserRepository
{
    public function __construct(private DocumentManager $documentManager)
    {
    }

    public function findById(string $id): ?User
    {
        $document = $this->documentManager->getRepository(UserDocument::class)->find($id);

        return $document?->toUser();
    }

    public function findAll(): array
    {
        $documents = $this->documentManager->getRepository(UserDocument::class)->findAll();

        return array_map(fn (UserDocument $document) => $document->toUser(), $documents);
    }

    public function save(User $user): void
    {
        $this->documentManager->persist(UserDocument::fromUser($user));
        $this->documentManager->flush();
    }
}
