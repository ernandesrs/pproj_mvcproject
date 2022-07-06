<?php

namespace Components\Uploader;

trait FileTrait
{
    /**
     * Upload de arquivso em geral
     * @param array $file
     * @param string $subDir
     * @return Uploader
     */
    public function file(array $file, string $subDir = "files"): Uploader
    {
        $this->uploaded = $file;
        $this->subDir = $subDir;
        $this->allowedMimes = $this->allowedFileMimes;

        return $this;
    }

    /**
     * @param array $allowedMimes
     * @return Uploader
     */
    public function fileMimes(array $allowedMimes): Uploader
    {
        $this->allowedFileMimes = $allowedMimes;
        $this->allowedMimes = $allowedMimes;
        return $this;
    }
}
