<?php

declare(strict_types=1);

namespace App\Playground\Post;

enum Status: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
}
