<?php

namespace Components\Thumb;

class Thumb extends SIManipulator
{

    /** @var string */
    protected $thumbsDir;

    /** @var string */
    protected $toExt;

    /** @var string */
    protected $thumbs;

    /**
     * @param string $dir
     */
    public function __construct(string $dir, ?string $toExt = "jpeg")
    {
        $this->thumbsDir = $dir;
        $this->toExt = $toExt ? (in_array($toExt, $this->allowedExtensions) ? $toExt : null) : null;
        $this->thumbs = "thumbs";

        if (!file_exists($this->thumbsDir . "/" . $this->thumbs))
            mkdir($this->thumbsDir . "/" . $this->thumbs);
    }

    /**
     * @param string $path
     * @param integer $w
     * @param integer|null $h
     * @return null|string
     */
    public function make(string $path, int $w, ?int $h = null): ?string
    {
        if (!$this->ioDefine($path, $w, $h))
            return null;

        if (!$this->checkExistence()) {
            if (!$this->load($path))
                return null;

            if (!$this->rotate())
                return null;

            if (!$this->resize())
                return null;

            if ($h)
                if (!$this->crop())
                    return null;

            if (!$this->save())
                return null;
        }

        return "/" . $this->thumbs . "/{$this->output["name"]}.{$this->output["extension"]}";
    }

    /**
     * @param string|null $path caminho absoluto para a imagem a ser deletada. Se null, limpa o diretório de uploads
     * @return void
     */
    public function unmake(?string $path = null)
    {
        $thumbnailsDir = "{$this->thumbsDir}/{$this->thumbs}";

        if (!$path)
            return $this->delTree($thumbnailsDir);

        $rmFileInfo = pathinfo($path);
        $files =  array_diff(scandir($thumbnailsDir) ?? [], array('.', '..'));

        foreach ($files as $file) {
            $encodedName = base64_encode($rmFileInfo["filename"]);
            if (strpos($file, $encodedName) !== false) {
                unlink($thumbnailsDir . "/{$file}");
            }
        }

        return;
    }

    /**
     * @param string $dir
     * @return void
     */
    private function delTree(string $dir)
    {
        $files = array_diff(scandir($dir) ?? [], array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return;
    }

    /**
     * @return boolean
     */
    private function checkExistence(): bool
    {
        $files = array_diff(scandir($this->thumbsDir . "/" . $this->thumbs) ?? [], array('.', '..'));
        $fileCheck = "{$this->output["name"]}.{$this->output["extension"]}";

        foreach ($files as $file) {
            if (strpos($file, $fileCheck) !== false)
                return true;
        }

        return false;
    }
}
