<?php

namespace Components\Uploader;

use Exception;
use stdClass;

class Uploader
{
    use ImageTrait;
    use MediaTrait;
    use FileTrait;

    /** @var array */
    protected $allowedImageMimes = [
        "image/png",
        "image/jpeg",
        "image/webp"
    ];

    /** @var array */
    protected $allowedMediaMimes = [
        "video/webm",
        "video/ogg",
        "video/mp4",

        "audio/mpeg",
        "audio/webm",
        "audio/ogg",
        "audio/wav"
    ];

    /** @var array */
    protected $allowedFileMimes = [
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "application/vnd.ms-fontobject",
        "application/vnd.oasis.opendocument.text",
        "application/pdf"
    ];

    /** @var array */
    protected $allowedMimes;

    /** @var string */
    protected $uploadDir;

    /** @var string */
    protected $subDir;

    /** @var bool */
    protected $dirByDate;

    /** @var array */
    protected $uploaded;

    /** @var Exception */
    protected $exception;

    /** @var array */
    protected $error;

    /**
     * @param string $uploadBaseDir
     */
    public function __construct(string $uploadBaseDir)
    {
        $this->uploadDir = $uploadBaseDir;
        $this->dirByDate = true;
    }

    /**
     * Armazena o arquivo
     * @param string|null $rename
     * @return string|null
     */
    public function store(?string $rename = null): ?string
    {
        if (!$this->validate())
            return null;

        $finalPath = $this->cmDirectory();

        $name = $this->uploaded["name"];
        $tmpName = $this->uploaded["tmp_name"];
        $ext = pathinfo($this->uploaded["name"], PATHINFO_EXTENSION);

        if ($rename) $newName = $rename;
        else $newName = base64_encode($name . "_" . time());

        $to = $finalPath . "/{$newName}.{$ext}";

        if (!is_uploaded_file($tmpName))
            return null;

        if (!move_uploaded_file($tmpName, $to))
            return null;

        return str_replace($this->uploadDir, "", $to);
    }

    /**
     * Define se serão criadas pastas baseadas no ano e mês
     * @param boolean $make
     * @return Uploader
     */
    public function dirByDate(bool $make = true): Uploader
    {
        $this->dirByDate = $make;
        return $this;
    }

    /**
     * Verifica e cria diretórios
     * @return string
     */
    private function cmDirectory(): string
    {
        $checkedDir = $this->uploadDir;
        if ($this->subDir) {
            $subDirsArr = explode("/", $this->subDir);
            foreach ($subDirsArr as $subDir) {
                $checkedDir .= "/" . $subDir;
                if (!is_dir($checkedDir))
                    mkdir($checkedDir);
            }
        }

        if ($this->dirByDate) {
            $year = date("Y");
            $month = date("m");

            $checkedDir .= "/{$year}";
            if (!is_dir($checkedDir))
                mkdir($checkedDir);

            $checkedDir .= "/{$month}";
            if (!is_dir($checkedDir))
                mkdir($checkedDir);
        }

        return $checkedDir;
    }

    /**
     * Validar arquivo
     * @return bool
     */
    private function validate(): bool
    {
        if (!in_array($this->uploaded["type"], $this->allowedMimes, true)) {
            $this->exception = new Exception("A extensão do arquivo enviado não é não aceito.");
            $this->error = [
                "message" => $this->exception->getMessage() . " Tipos aceitos: " . implode(", ", $this->allowedMimes),
                "allowedExtensions" => implode(", ", $this->allowedMimes),
            ];
            return false;
        }

        return true;
    }

    /**
     * @return stdClass|null
     */
    public function error(): ?stdClass
    {
        return ($this->error ?? null) ? (object) $this->error : null;
    }
}
