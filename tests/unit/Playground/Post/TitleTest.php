<?php

declare(strict_types=1);

namespace App\Tests\Unit\Playground\Post;

use App\Playground\Post\Title;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TitleTest extends TestCase
{
    #[Test]
    public function it_should_expose_the_title(): void
    {
        $title = new Title('Test Title');

        self::assertSame('Test Title', $title->toString());
    }
}
