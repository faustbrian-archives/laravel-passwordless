<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Passwordless.
 *
 * (c) Konceiver Oy <info@konceiver.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Konceiver\Passwordless\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Konceiver\Passwordless\Http\Middleware\PassphraseGuard;
use Konceiver\Passwordless\Listeners\RequirePassphrase;

final class PasswordlessServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/passwordless.php', 'passwordless');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/passwordless.php' => $this->app->configPath('passwordless.php'),
            ], 'passwordless-config');

            $this->publishes([
                __DIR__.'/../../resources/views' => $this->app->resourcePath('views/vendor/passwordless'),
            ], 'passwordless-views');
        }

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'passwordless-views');

        $this->bootEventListeners();

        $this->bootMiddleware();
    }

    private function bootEventListeners(): void
    {
        Event::listen(\Illuminate\Auth\Events\Login::class, RequirePassphrase::class);
        Event::listen(\Illuminate\Auth\Events\Registered::class, RequirePassphrase::class);
    }

    private function bootMiddleware(): void
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->pushMiddlewareToGroup('web', PassphraseGuard::class);
    }
}
