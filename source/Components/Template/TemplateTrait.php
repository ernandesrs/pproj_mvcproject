<?php

namespace Components\Template;

trait TemplateTrait
{
    /**
     * Informações para SEO
     * @param string|null $title
     * @param string|null $desc
     * @param string|null $url
     * @param string|null $image
     * @param boolean $follow
     * @return Template
     */
    public function seo(
        ?string $title = null,
        ?string $desc = null,
        ?string $url = null,
        ?string $image = null,
        bool $follow = true
    ): Template {
        $this->addData([
            "seo" => (object) [
                "title" => $title,
                "description" => $desc,
                "url" => $url,
                "image" => $image,
                "follow" => $follow ? "index,follow" : "noindex,nofollow",
            ]
        ]);
        return $this;
    }

    /**
     * @param array $data
     * @return Template
     */
    public function addData(array $data): Template
    {
        if (empty($this->data))
            $this->data = [];
        $this->data += $data;
        return $this;
    }

    /**
     * @param string $view
     * @return Template
     */
    public function addView(string $view): Template
    {
        $this->viewName = $view;
        return $this;
    }

    /**
     * @param string $name
     * @return void
     */
    public function layout(string $name)
    {
        $this->layoutName = $name;
        return;
    }

    /**
     * Sinaliza início da definição de valores para uma seção definida layout
     * @param string $name
     * @return string
     */
    public function start(string $name): string
    {
        $this->sections[$name] = null;
        return $this->startStr($name);
    }

    /**
     * Sinaliza fim da definição de valores para uma seção definida layout
     * @param string $name
     * @return string
     */
    public function end(string $name): string
    {
        return $this->endStr($name);
    }

    /**
     * Define o local de uma seção
     * @param string $name
     * @return void
     */
    public function section(string $name)
    {
        echo $this->sections[$name] ?? null;
        return;
    }

    /**
     * Sinalizador de início de valores de seção
     * @param string $name
     * @return string
     */
    private function startStr(string $name): string
    {
        return "<erste-{$name}section>";
    }

    /**
     * Sinalizador de fim de valores de seção
     * @param string $name
     * @return string
     */
    private function endStr(string $name): string
    {
        return "</erste-{$name}section>";
    }
}
