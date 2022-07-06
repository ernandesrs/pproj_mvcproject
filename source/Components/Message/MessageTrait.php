<?php

namespace Components\Message;

trait MessageTrait
{
    /**
     * @param string $message
     * @param string|null $title
     * @return Message
     */
    public function success(string $message, ?string $title = null): Message
    {
        $this->message($message, $title, self::STYLE_SUCCESS);
        return $this;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Message
     */
    public function info(string $message, ?string $title = null): Message
    {
        $this->message($message, $title, self::STYLE_INFO);
        return $this;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Message
     */
    public function danger(string $message, ?string $title = null): Message
    {
        $this->message($message, $title, self::STYLE_DANGER);
        return $this;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Message
     */
    public function warning(string $message, ?string $title = null): Message
    {
        $this->message($message, $title, self::STYLE_WARNING);
        return $this;
    }

    /**
     * @param string $message
     * @param string|null $title
     * @return Message
     */
    public function default(string $message, ?string $title = null): Message
    {
        $this->message($message, $title, self::STYLE_DEFAULT);
        return $this;
    }

    /**
     * @return Message
     */
    public function fixed(): Message
    {
        $this->type = self::TYPE_FIXED;
        $this->timer = null;
        return $this;
    }

    /**
     * @param float $time
     * @return Message
     */
    public function float(float $time = 7.5): Message
    {
        $this->type = self::TYPE_FLOAT;
        $this->time($time);
        return $this;
    }

    /**
     * @param float $time
     * @return Message
     */
    public function time(float $time = 7.5): Message
    {
        $this->timer = $time;
        return $this;
    }
}
