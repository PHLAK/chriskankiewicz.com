<?php

declare(strict_types=1);

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Views\Twig;

class RegisterGlobalsMiddleware
{
    public function __construct(
        private Twig $view,
    ) {}

    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        $twigEnvironment = $this->view->getEnvironment();

        $twigEnvironment->addGlobal('sub_title', $this->subTitle());

        return $handler->handle($request);
    }

    private function subTitle(): string
    {
        $items = [
            '👨‍💻 Passionate PHP developer',
            '🐧 Linux junkie',
            '🧙‍♂️ Open sourcerer',
            '🖥️ Avid PC gamer',
            '☕️ Coffee aficionado',
            '🛠️ Tinkerer',
            '👫 Dedicated husband',
            '👨‍👧‍👦 Proud father of two',
        ];

        return $items[array_rand($items)];
    }
}
