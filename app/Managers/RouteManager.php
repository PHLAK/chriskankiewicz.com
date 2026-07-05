<?php

declare(strict_types=1);

namespace App\Managers;

use App\Controllers;
use DI\Attribute\Inject;
use DI\Container;
use Slim\App;

class RouteManager
{
    /** @var App<Container> $app */
    #[Inject(App::class)]
    private App $app;

    public function __invoke(): void
    {
        $this->app->get('/', Controllers\IndexController::class)->setName('index');
    }
}
