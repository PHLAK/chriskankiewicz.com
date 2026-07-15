<?php

declare(strict_types=1);

namespace Tests\Controllers;

use App\Clients\Blog\BlogClientInterface;
use App\Clients\GitHub\GitHubClientInterface;
use App\Controllers\IndexController;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;
use Slim\Views\Twig;
use Tests\TestCase;

#[CoversClass(IndexController::class)]
class IndexControllerTest extends TestCase
{
    #[Test]
    public function it_returns_the_list_of_posts_for_a_given_page(): void
    {
        $github = $this->mock(GithubClientInterface::class);
        $github->expects($this->exactly(12))->method('repository')->withParameterSetsInOrder(
            ['phlak', 'plume'],
            ['directorylister', 'directorylister'],
            ['phlak', 'twine'],
            ['phlak', 'splat'],
            ['phlak', 'semver'],
            ['phlak', 'chronometer'],
            ['phlak', 'stash'],
            ['phlak', 'config'],
            ['phlak', 'vuecolorclock'],
            ['phlak', 'docker-minecraft'],
            ['phlak', 'uses'],
            ['phlak', 'dotfiles'],
        )->willReturn((object) []);

        $blog = $this->mock(BlogClientInterface::class);
        $blog->expects($this->once())->method('posts')->with(6)->willReturn([]);

        $twig = $this->mock(Twig::class);
        $twig->expects($this->once())->method('render')->with($testResponse = new Response, 'index.twig', [
            'projects' => Collection::times(12, fn (): object => (object) []),
            'posts' => [],
        ])->willReturn(
            $testResponse->withStatus(StatusCodeInterface::STATUS_OK)
        );

        $response = $this->container->call(IndexController::class, ['response' => $testResponse]);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertSame(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
    }
}
