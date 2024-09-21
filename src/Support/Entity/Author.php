<?php

namespace HypernosTechnology\SocialPostApi\Support\Entity;

use HypernosTechnology\SocialPostApi\Support\HasThumbnail;

class Author extends Entity
{
    use HasThumbnail;

    public string $name;

    public string $avatar_url;

    public function __construct(array $data)
    {
        $this->gid = $data['author_gid'];
        $this->name = $data['author_name'];
        $this->avatar_url = $data['author_thumbnail_url'];
    }

    public function downloadAvatar(): void
    {
        $this->cacheThumbnail(
            'images/showcase-authors/' . substr($this->gid, 0, 2) . '/' . substr($this->gid, 2, 2),
            $this->gid,
            $this->avatar_url,
            120,
        );
    }
}
