<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\Telescope;
use Laravel\Telescope\TelescopeApplicationServiceProvider;

class TelescopeServiceProvider extends TelescopeApplicationServiceProvider
{
    /** Register any application services. */
    public function register(): void
    {
        // Telescope::night();

        $this->hideSensitiveRequestDetails();
    }

    /** Prevent sensitive request details from being logged by Telescope. */
    protected function hideSensitiveRequestDetails(): void
    {
        if ($this->app->environment('local', 'docker')) {
            return;
        }

        Telescope::hideRequestParameters(['_token']);

        Telescope::hideRequestHeaders([
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
        ]);
    }

    /**
     * Register the Telescope gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewTelescope', function ($user) {
            return $user->is_admin;
        });
    }
}
