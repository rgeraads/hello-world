<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * Overrides the need of composer.json to be present in the repository, e.g. on production.
     */
    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }
}
