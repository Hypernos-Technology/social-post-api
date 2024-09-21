<?php

namespace HypernosTechnology\SocialPostApi;

use HypernosTechnology\SocialPostApi\Support\Entity\Author;
use HypernosTechnology\SocialPostApi\Support\Task;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class SocialPostApiClient
{
    protected PendingRequest $http;

    protected $response;

    public function __construct()
    {
        $this->http = Http::withToken(config('social-post-api.token'));
    }

    public function createTask(array $urls): static
    {
        $this->response = $this->http->post('https://social-api.hypernos.com/api/v1/run', [
            'urls' => $urls,
        ]);

        if (!$this->response->ok()) {
            throw new \Exception('Failed to run the task.');
        }

        return $this;
    }

    public function getData(string $task_id)
    {
        $this->response = $this->http->get('https://social-api.hypernos.com/api/v1/task/' . $task_id);

        return Task::parseFromHttp($this->response->json());
    }

    public function toObject(): object
    {
        return $this->response->object();
    }

    public function toArray(): array
    {
        return $this->response->json();
    }
}
