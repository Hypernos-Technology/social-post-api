<?php

namespace HypernosTechnology\SocialPostApi;

use Illuminate\Support\ServiceProvider;

class SocialPostApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // register config file
        $this->mergeConfigFrom(__DIR__ . '/../config/social-post-api.php', 'social-post-api');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
