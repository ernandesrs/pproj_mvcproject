<?php

namespace App\Models;

class Product extends Model
{
    public const PURCHASE_UNIT = 1;
    public const PURCHASE_PACKAGE = 2;
    public const PURCHASE_PACKAGE_GROUP = 3;
    public const PURCHASE_MODES = [
        self::PURCHASE_UNIT,
        self::PURCHASE_PACKAGE,
        self::PURCHASE_PACKAGE_GROUP,
    ];

    public const SALE_UNIT = 1;
    public const SALE_PACKAGE = 2;
    public const SALE_PACKAGE_GROUP = 3;
    public const SALE_MODES = [
        self::SALE_UNIT,
        self::SALE_PACKAGE,
        self::SALE_PACKAGE_GROUP
    ];

    public function __construct()
    {
        parent::__construct("products", ["name", "purchase_mode", "sale_mode"]);
    }

    /**
     * @param array $data
     * @return boolean
     */
    public function set(array $data): bool
    {
        if (!$this->filter($data))
            return false;

        if (!$this->validate($data))
            return false;

        $this->name = strtoupper($this->filtered["name"]);
        $this->purchase_mode = $this->filtered["purchase_mode"];
        $this->sale_mode = $this->filtered["sale_mode"];

        return true;
    }

    /**
     * @param array $data
     * @return boolean
     */
    private function filter(array $data): bool
    {
        $this->filtered["name"] = filter_var($data["name"] ?? null);
        $this->filtered["purchase_mode"] = filter_var($data["purchase_mode"] ?? null, FILTER_VALIDATE_INT);
        $this->filtered["sale_mode"] = filter_var($data["sale_mode"] ?? null, FILTER_VALIDATE_INT);

        foreach ($this->filtered as $key => $filtered) {
            if (empty($filtered))
                $this->errors[$key] = "Este é um campo obrigatório";
        }

        return $this->hasErrors();
    }

    /**
     * @return boolean
     */
    private function validate(): bool
    {
        $this->errors = [];

        // PURCHASE MODE VALIDATE
        if (!in_array($this->filtered["purchase_mode"], self::PURCHASE_MODES))
            $this->errors["purchase_mode"] = "Escolha um modo de compra válido";

        // SALE MODE VALIDATE
        if (!in_array($this->filtered["sale_mode"], self::SALE_MODES))
            $this->errors["sale_mode"] = "Escolha um modo de venda válido";
        else {
            if ($this->filtered["sale_mode"] > $this->filtered["purchase_mode"])
                $this->errors["sale_mode"] = "Modo de venda não válido para o tipo de compra selecionado";
        }

        $rules = "name=:name AND purchase_mode=:pm AND sale_mode=:sm";
        $rulesValue = "name={$this->filtered["name"]}&pm={$this->filtered["purchase_mode"]}&sm={$this->filtered["sale_mode"]}";
        if (!empty($this->id)) {
            $rules .= " AND id!=:id";
            $rulesValue .= "&id={$this->id}";
        }

        if ($this->find($rules, $rulesValue)->count())
            $this->errors["name"] = "Um produto com este nome e com os mesmos modos de compra e venda já está registrado";

        return $this->hasErrors();
    }
}
