<?php

namespace Components\Session;

use stdClass;

class Session
{
    use SessionTrait;

    /** @var stdClass */
    private $data;

    public function __construct()
    {
        $this->data = (object) $_SESSION;
    }
}
