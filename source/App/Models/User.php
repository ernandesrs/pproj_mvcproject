<?php

namespace App\Models;

class User extends Model
{
    public const GENDER_MALE = "m";
    public const GENDER_FEMALE = "f";
    public const ALLOWED_GENDERS = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
    ];

    public const LEVEL_ONE = 1;
    public const LEVEL_SEVEN = 7;
    public const LEVEL_ADMIN = 8;
    public const LEVEL_MASTER = 9;
    public const ALLOWED_LEVELS = [
        self::LEVEL_ONE,
        self::LEVEL_SEVEN,
        self::LEVEL_ADMIN,
        self::LEVEL_MASTER,
    ];

    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name", "username", "email", "password", "gender"]);
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function set(array $data): bool
    {
        if (!$this->filter($data)) return false;

        if (!$this->validate()) return false;

        // SE POSSUI O CAMPO SENHA, GERA A HASH
        if ($this->filtered["password"] ?? false)
            $this->filtered["password"] = password_hash($this->filtered["password"], PASSWORD_DEFAULT);

        // EM UM UPDATE, CERTIFICA-SE DE QUE O NÍVEL NÃO SEJA PROPRIETÁRIO
        if (!empty($this->id) && $this->level != self::LEVEL_MASTER) {
            if ($this->filtered["level"] >= self::LEVEL_MASTER)
                $this->filtered["level"] = $this->level;
        }

        // EM UM INSERT, IMPEDE QUE NOVO USUÁRIO SEJA DEFINIDO COMO PROPRIETÁRIO
        if (empty($this->id) && $this->filtered["level"] >= self::LEVEL_MASTER)
            $this->filtered["level"] = self::LEVEL_ONE;

        foreach ($this->filtered as $filteredKey => $filteredData) {
            $this->$filteredKey = $filteredData;
        }

        return true;
    }

    /**
     * @param array $data
     * @return boolean
     */
    private function filter(array $data): bool
    {
        $this->filtered["first_name"] = filter_var($data["first_name"] ?? null);
        $this->filtered["last_name"] = filter_var($data["last_name"] ?? null);
        $this->filtered["username"] = filter_var($data["username"] ?? null);
        $this->filtered["email"] = filter_var($data["email"] ?? null, FILTER_VALIDATE_EMAIL);
        $this->filtered["level"] = filter_var($data["level"] ?? null, FILTER_VALIDATE_INT);
        $this->filtered["gender"] = filter_var($data["gender"] ?? null);
        $this->filtered["password"] = filter_var($data["password"] ?? null);
        $this->filtered["password_confirm"] = filter_var($data["password_confirm"] ?? null);

        if (!empty($this->id) && empty($this->filtered["password"]))
            unset($this->filtered["password"], $this->filtered["password_confirm"]);

        foreach ($this->filtered as $key => $filtered) {
            if (empty($filtered))
                $this->errors[$key] = "Este é um campo é obrigatório";
        }

        return $this->hasErrors();
    }

    /**
     * @return boolean
     */
    private function validate(): bool
    {
        $this->errors = [];

        // USERNAME
        $rules = "username=:usrn";
        $rValues = "usrn={$this->filtered['username']}";
        if (!empty($this->id)) {
            $rules .= " AND id!=:id";
            $rValues .= "&id=" . $this->id;
        }

        if ($this->find($rules, $rValues)->count())
            $this->errors["username"] = "Este nome de usuário já está sendo utilizado";


        // EMAIL
        $rules = "email=:email";
        $rValues = "email={$this->filtered['email']}";
        if (!empty($this->id)) {
            $rules .= " AND id!=:id";
            $rValues .= "&id=" . $this->id;
        }

        if ($this->find($rules, $rValues)->count())
            $this->errors["email"] = "Este email já está cadastrado";

        // LEVEL
        if (($this->filtered["level"] ?? null) && !in_array($this->filtered["level"], self::ALLOWED_LEVELS))
            $this->errors["level"] = "Nível de usuário inválido";

        // GENDER
        if (!in_array($this->filtered["gender"], self::ALLOWED_GENDERS))
            $this->errors["gender"] = "Escolha uma opção";

        // PASSWORD
        if (($this->filtered["password"] ?? null) && $this->filtered["password"] != $this->filtered["password_confirm"])
            $this->errors["password"] = "As senhas não conferem";
        else
            unset($this->filtered["password_confirm"]);

        return $this->hasErrors();
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function activityReport(array $data): bool
    {
        /** @var ActivityReport */
        $activityReport = (new ActivityReport())->find("users_id=:ui", "ui={$this->id}")->get();

        if (!$activityReport)
            $activityReport = new ActivityReport();

        $activityReport->set($this, $data);

        return $activityReport->save();
    }

    /**
     * 
     */
    public function lastActivityReport()
    {
        return (new ActivityReport())->find("users_id=:ui", "ui={$this->id}")->get();
    }
}
