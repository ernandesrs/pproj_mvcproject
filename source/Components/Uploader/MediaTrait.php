<?php

namespace Components\Uploader;

trait MediaTrait
{
    /**
     * Upload de audio e vídeos
     * @param array $media
     * @param string $subDir
     * @return Uploader
     */
    public function media(array $media, string $subDir = "medias"): Uploader
    {
        $this->uploaded = $media;
        $this->subDir = $subDir;
        $this->allowedMimes = $this->allowedMediaMimes;

        return $this;
    }

    /**
     * @param array $allowedMimes
     * @return Uploader
     */
    public function mediaMimes(array $allowedMimes): Uploader
    {
        $this->allowedMediaMimes = $allowedMimes;
        $this->allowedMimes = $allowedMimes;
        return $this;
    }
}
