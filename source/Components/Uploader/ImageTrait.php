<?php

namespace Components\Uploader;

trait ImageTrait
{
    /**
     * Upload de imagens
     * @param array $image
     * @param string $subDir
     * @return Uploader
     */
    public function image(array $image, string $subDir = "images"): Uploader
    {
        $this->uploaded = $image;
        $this->subDir = $subDir;
        $this->allowedMimes = $this->allowedImageMimes;

        return $this;
    }

    /**
     * @param array $allowedMimes
     * @return Uploader
     */
    public function imageMimes(array $allowedMimes): Uploader
    {
        $this->allowedImageMimes = $allowedMimes;
        $this->allowedMimes = $allowedMimes;
        return $this;
    }
}
