<?php

namespace HypernosTechnology\SocialPostApi\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasThumbnail
{
    protected function cacheThumbnail(
        string $dir,
        string $filename,
        string $image_url,
        ?int   $max_width = null,
        string $format = 'jpg'
    ): void {
        if ($max_width)
            $image_url .= "?imageView2/2/w/$max_width/format/$format%7CimageMogr2/strip";

        Storage::disk('public')->put("$dir/$filename.png", $this->getImageContent($image_url));
    }

    private function getImageContent(string $url): ?string
    {
        if (app()->runningUnitTests())
            UploadedFile::fake()->image('image.png')->getContent();

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $imageData = curl_exec($ch);

        if ($imageData === false) {
            return null;
        }

        if (curl_errno($ch)) {
            print('Error: ' . curl_error($ch));
            curl_close($ch);
            return null;
        }

        curl_close($ch);
        return $imageData;
    }

}
