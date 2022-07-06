<?php

namespace Components\Session;

use stdClass;

trait SessionTrait
{
    /**
     * @param string $key
     * @param [type] $value
     * @return bool
     */
    public function add(string $key, $value): bool
    {
        if (empty($this->data))
            $this->data = new stdClass;
        $this->data->$key = $value;
        return $this->updateSession();
    }

    /**
     * @param string $key
     * @param [type] $value
     * @return boolean
     */
    public function update(string $key, $value): bool
    {
        return $this->add($key, $value);
    }

    /**
     * @param string $key
     * @return
     */
    public function get(string $key)
    {
        return $this->data->$key ?? null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function remove(string $key): bool
    {
        unset($this->data->$key);
        return $this->updateSession();
    }

    /**
     * @return bool
     */
    private function updateSession(): bool
    {
        $_SESSION = (array) $this->data;
        return true;
    }

    /**
     * @return stdClass|null
     */
    public function data(): ?stdClass
    {
        return $this->data ?? null;
    }
}
