<?php

namespace HypernosTechnology\SocialPostApi\Support;


use Illuminate\Support\Collection;

class Task
{
    protected string $task_id;

    protected Collection $data;

    public function __construct(array $data = [])
    {
        $this->task_id = $data['task_id'];

        $this->parseData($data['data']);
    }

    public static function parseFromHttp(array $data)
    {
        return new static($data);
    }

    private function parseData(mixed $data)
    {
        $this->data = collect();

        foreach ($data as $post) {
            $this->data->push([
                // author
                new Entity\Author([
                    'author_gid' => $post['user']['gid'],
                    'author_name' => $post['user']['name'],
                    'author_thumbnail_url' => $post['user']['avatar'],
                ]),
                // post
                new Entity\Post([
                    'post_gid' => $post['gid'],
                    'title' => $post['title'],
                    'cover' => $post['cover'],
                ]),
            ]);
        }
    }

    public function taskId(): string
    {
        return $this->task_id;
    }

    public function data(): Collection
    {
        return $this->data;
    }
}
