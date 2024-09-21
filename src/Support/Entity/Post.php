<?php

namespace HypernosTechnology\SocialPostApi\Support\Entity;

use HypernosTechnology\SocialPostApi\Support\HasThumbnail;

class Post extends Entity
{
    use HasThumbnail;

    public string $title;

    public string $cover_url;

    public function __construct(array $data)
    {
        $this->gid = $data['post_gid'];
        $this->title = $data['title'];
        $this->cover_url = $data['cover'];
    }

    public function downloadCover(): void
    {
        $this->cacheThumbnail(
            'images/showcases/' . substr($this->gid, 0, 2) . '/' . substr($this->gid, 2, 2),
            $this->gid,
            $this->cover_url,
            1000 // cache max 1000px height thumbnail
        );
    }
}
