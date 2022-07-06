<?php

namespace Components\Message;

class Message
{
    use MessageTrait;

    public const TYPE_FLOAT = "float";
    public const TYPE_FIXED = "fixed";

    public const STYLE_SUCCESS = "success";
    public const STYLE_INFO = "info";
    public const STYLE_DANGER = "danger";
    public const STYLE_WARNING = "warning";
    public const STYLE_DEFAULT = "secondary";

    /** @var string */
    private $title;

    /** @var string */
    private $message;

    /** @var string */
    private $style;

    /** @var string */
    private $type;

    /** @var float */
    private $timer;

    public function __construct()
    {
        $this->title = null;
        $this->message = null;
        $this->style = self::STYLE_DEFAULT;
        $this->type = self::TYPE_FIXED;
        $this->timer = null;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @param string $style
     * @return Message
     */
    public function message(string $message, ?string $title = null, string $style = self::STYLE_DEFAULT): Message
    {
        $this->message = $message;
        $this->title = $title;
        $this->style = $style;
        return $this;
    }

    /**
     * Adiciona/obtém mensagem na/da sessão
     * 
     * Quando invocado em um objeto com dados preenchidos, adiciona o objeto na sessão.
     * Quando invocado em novo objeto obtém e retorna um objeto Message quando existir na sessão ou null quando não existir
     * @return void|null|Message
     */
    public function flash()
    {
        if ($this->message) {
            $_SESSION["flashMessage"] = serialize($this);
            return;
        }

        $message = $_SESSION["flashMessage"] ?? null;
        if ($message)
            unset($_SESSION["flashMessage"]);

        return $message ? unserialize($message) : null;
    }

    /**
     * @return string
     */
    public function json(): string
    {
        return json_encode([
            "title" => $this->title,
            "message" => $this->message,
            "type" => $this->type,
            "style" => $this->style,
            "timer" => $this->timer,
        ]);
    }

    /**
     * Retorna HTML baseado em componente de alerta do Bootstrap
     * @return string
     */
    public function render(): string
    {
        $title = $this->title ? "<h4 class='alert-heading'>{$this->title}</h4>" : null;
        $body = "<div class='alert-body'>{$this->message}</div>";
        $timer = $this->timer ? ("data-timer=" . $this->timer) : null;
        $message = "<div class='alert alert-{$this->style} alert-{$this->type} alert-dismissible fade show' role='alert' {$timer}><div>{$title}{$body}</div><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span></button></div>";
        return $message;
    }
}
