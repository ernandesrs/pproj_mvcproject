<?php

namespace Components\Template;

use Exception;

/**
 * Baseada em Plates
 */
class Template
{
    use TemplateTrait;

    /** @var String */
    private $dir;

    /** @var String */
    private $ext;

    /** @var String */
    private $layoutName;

    /** @var String */
    private $viewName;

    /** @var Array */
    private $data;

    /** @var Array */
    private $sections;

    /**
     * @param string $dir caminho absoluto para diretório principal de views
     * @param string $ext extensão das views
     */
    public function __construct(string $dir, string $ext = "php")
    {
        $this->dir = $dir;
        $this->ext = $ext;
    }

    /**
     * Extrai da view informada os valores de seções definidas no layout
     * @param string $view
     * @return void
     */
    private function getSections(string $view): void
    {
        if (!is_array($this->sections))
            return;

        $vCpy = $view;
        foreach ($this->sections as $key => $value) {
            $this->sections[$key] = substr(
                $vCpy,
                strpos($vCpy, $this->startStr($key)),
                (strpos($vCpy, $this->endStr($key)) + strlen($this->endStr($key)))
            );

            $vCpy = str_replace($this->sections[$key], "", $vCpy);

            $this->sections[$key] = str_replace(
                [$this->startStr($key), $this->endStr($key)],
                "",
                $this->sections[$key]
            );
        }
        return;
    }

    /**
     * @return void
     */
    public function render()
    {
        /** @var Template $v */
        $v = $this;

        foreach ($v->data as $key => $value) {
            if (is_array($value)) $$key = $value;
            else $$key = $value;
        }

        $viewPath = $v->dir . "/" . $v->viewName . "." . $v->ext;
        if (!file_exists($viewPath)) {
            throw new Exception("View '{$v->viewName}' não encontrada");
            return;
        }

        ob_start();
        require $viewPath;
        $view = ob_get_clean();

        if (empty($v->layoutName)) $v->layoutName = $v->viewName;
        else $v->getSections(trim($view));

        require $v->dir . "/{$v->layoutName}.{$v->ext}";

        return;
    }
}
