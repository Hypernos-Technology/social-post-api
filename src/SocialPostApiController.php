<?php

namespace HypernosTechnology\SocialPostApi;

use HypernosTechnology\SocialPostApi\Events\SocialPostApiCompleted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialPostApiController
{
    public function webhook(Request $request): JsonResponse
    {
        event(new SocialPostApiCompleted($request->all()));

        return response()->json(['message' => 'Webhook received.']);
    }
}
