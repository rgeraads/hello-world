<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

passthru(sprintf('php bin/console doctrine:database:drop --if-exists --quiet --env=%s', 'test'));
passthru(sprintf('php bin/console doctrine:database:create --if-not-exists --quiet --env=%s', 'test'));
passthru(sprintf('php bin/console doctrine:migrations:migrate --no-interaction --quiet --env=%s', 'test'));
