<?php

namespace Components\Base;

use Exception;
use PDO;
use PDOException;

abstract class Connect
{
    /** @var PDOException */
    protected $exception;

    /** @var PDO */
    protected $connection;

    public function __construct()
    {
        $dsn = "mysql:dbname=" . CONF_DBASE_NAME . ";host=" . CONF_DBASE_HOST . (empty(CONF_DBASE_PORT) ? null : ";port=" . CONF_DBASE_PORT);
        $user = CONF_DBASE_USER;
        $pass = CONF_DBASE_PASS;
        $opt = CONF_DBASE_OPTIONS;

        try {
            $this->connection = new PDO($dsn, $user, $pass, $opt);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
            $this->connection = null;
        }
    }

    /**
     * @return PDO|null
     */
    protected function getConnection(): ?PDO
    {
        return $this->connection;
    }
}
