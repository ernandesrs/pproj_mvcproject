<?php

namespace App\Models;

use Components\Base\Base;
use stdClass;

class Model extends Base
{
    /** @var array */
    protected $errors;

    /** @var array */
    protected $filtered;

    /**
     * @param string $table
     * @param array $required
     * @param boolean $timestamps
     */
    public function __construct(string $table, array $required = [], bool $timestamps = true)
    {
        parent::__construct($table, $required, $timestamps);
    }

    /**
     * @return null|stdClass
     */
    public function paginate(): ?stdClass
    {
        if (empty($this->offset) || empty($this->limit))
            return null;

        $total = $this->count();
        return (object) [
            "total" => $total,
            "currentPage" => $this->offset,
            "pages" => ceil($total / $this->limit)
        ];
    }

    /**
     * @return boolean
     */
    protected function hasErrors(): bool
    {
        return count($this->errors ?? []) == 0 ? true : false;
    }

    /**
     * @return array|null
     */
    public function errors(): ?array
    {
        return $this->errors;
    }
}
