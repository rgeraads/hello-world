<?php

declare(strict_types=1);

namespace App\OpenAI;

enum Language: string
{
    case ENGLISH = 'english';
    case DUTCH = 'dutch';
    case GERMAN = 'german';
    case FRENCH = 'french';
}
