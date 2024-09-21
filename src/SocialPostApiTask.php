<?php

namespace HypernosTechnology\SocialPostApi;

class SocialPostApiTask
{
    protected array $urls = [];

    public static function make(): self
    {
        return new static();
    }

    public function addUrls(array $urls): self
    {
        $this->urls = $urls;

        return $this;
    }

    public function run(): object
    {
        $client = new SocialPostApiClient();

        return $client->createTask($this->urls)->toObject();
    }
}
