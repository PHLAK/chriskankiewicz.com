<?php

declare(strict_types=1);

use App\Decorators;
use App\Factories;
use App\Functions;
use App\Managers;
use App\Middlewares;
use GuzzleHttp\Client;

use function DI\create;
use function DI\decorate;
use function DI\factory;
use function DI\get;
use function DI\string;

return [

    // -------------------------------------------------------------------------
    // Path definitions
    // -------------------------------------------------------------------------

    'base_path' => dirname(__DIR__),
    'app_path' => string('{base_path}/app'),
    'config_path' => string('{base_path}/config'),
    'resources_path' => string('{base_path}/resources'),
    'icons_path' => string('{resources_path}/icons'),
    'views_path' => string('{resources_path}/views'),

    // Cache paths
    'cache_path' => string('{base_path}/cache'),
    'app_cache' => string('{cache_path}/app'),

    // Public asset paths
    'public_path' => string('{base_path}/public'),
    'build_path' => string('{public_path}/build'),
    'assets_path' => string('{build_path}/assets'),
    'manifest_path' => string('{build_path}/manifest.json'),

    // -------------------------------------------------------------------------
    // Application managers
    // -------------------------------------------------------------------------

    'managers' => [
        Managers\MiddlewareManager::class,
        Managers\RouteManager::class,
    ],

    // -------------------------------------------------------------------------
    // Application middlewares
    // -------------------------------------------------------------------------

    'middlewares' => [
        Middlewares\PruneCacheMiddleware::class,
        Middlewares\RegisterGlobalsMiddleware::class,
        function (Slim\App $app, Slim\Views\Twig $twig): Slim\Views\TwigMiddleware {
            return Slim\Views\TwigMiddleware::create($app, $twig);
        },
    ],

    // -------------------------------------------------------------------------
    // View filters & functions
    // -------------------------------------------------------------------------

    'view_filters' => [],

    'view_functions' => [
        Functions\Config::class,
        Functions\Gravatar::class,
        Functions\Svg::class,
        Functions\Vite::class,
    ],

    // -------------------------------------------------------------------------
    // App factories and decorators
    // -------------------------------------------------------------------------

    Slim\App::class => factory(Factories\AppFactory::class),
    Slim\Views\Twig::class => factory(Factories\TwigFactory::class),
    Slim\Interfaces\RouteParserInterface::class => factory(Factories\RouteParserFactory::class),
    Symfony\Contracts\Cache\CacheInterface::class => factory(Factories\CacheFactory::class),
    App\Clients\Blog\BlogClientInterface::class => factory(Factories\BlogClientFactory::class),
    App\Clients\GitHub\GitHubClientInterface::class => factory(Factories\GitHubClientFactory::class),
];
