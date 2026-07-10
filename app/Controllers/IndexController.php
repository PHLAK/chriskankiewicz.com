<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Clients\Blog\BlogClientInterface;
use App\Clients\GitHub\GitHubClientInterface;
use App\Helpers\Str;
use DI\Attribute\Inject;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class IndexController
{
    #[Inject('projects')]
    private array $projects;

    #[Inject(GitHubClientInterface::class)]
    private GitHubClientInterface $github;

    #[Inject(BlogClientInterface::class)]
    private BlogClientInterface $blog;

    public function __construct(
        private Twig $view,
    ) {}

    public function __invoke(Response $response): ResponseInterface
    {
        return $this->view->render($response, 'index.twig', [
            'projects' => $this->projects(),
            'posts' => $this->blog->posts(6),
        ]);
    }

    /** @return Collection<object> */
    private function projects(): Collection
    {
        return new Collection($this->projects)->map(function (string $project): object {
            [$owner, $repository] = Str::extract('/(.+)\/(.+)/', $project);

            return $this->github->repository($owner, $repository);
        });
    }
}
