<?php

namespace HypernosTechnology\SocialPostApi;

use Illuminate\Support\Facades\Route;

class SocialPostApi
{
    public static function registerRoutes()
    {
        Route::post('/webhook_social_post_api', [SocialPostApiController::class, 'webhook']);
    }
}
