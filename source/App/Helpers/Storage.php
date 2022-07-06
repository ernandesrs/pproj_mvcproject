<?php

namespace App\Helpers;

use Components\Uploader\Uploader;

/**
 * 
 * Extende Uploader e adicionar utilitários
 * 
 */
class Storage extends Uploader
{
    /** @var string */
    private $uploadedPath;

    public function __construct()
    {
        parent::__construct(CONF_BASE_DIR . CONF_UPLOAD_BASE_DIR);
    }

    /**
     * Armazena o arquivo
     * @param string|null $rename
     * @return string|null
     */
    public function store(?string $rename = null): ?string
    {
        $this->uploadedPath = parent::store($rename);
        return $this->uploadedPath;
    }

    /**
     * @param string $path caminho para o arquivo a partir da pasta de uploads
     * @return void
     */
    public function unlink(string $path): void
    {
        $path = $this->uploadDir . $path;

        if (file_exists($path)) {
            Thumb::thumbClear($path);
            unlink($path);
        }

        return;
    }

    /**
     * @return void
     */
    public function unlinkLast(): void
    {
        if (empty($this->uploadedPath))
            return;

        $this->unlink($this->subdir . $this->uploadedPath);

        return;
    }

    /**
     * @param string|null $path
     * @return string
     */
    public function url(?string $path = null): string
    {
        return url(CONF_UPLOAD_BASE_DIR . ($path ?? $this->uploadedPath));
    }

    /**
     * @param string|null $path
     * @return string
     */
    public function path(?string $path = null): string
    {
        return $this->uploadDir . ($path ?? $this->uploadedPath);
    }
}
