<?php

namespace App\Controllers\Dash;

use App\Models\Product;

class ProductController extends DashController
{
    /**
     * @param [type] $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * @return void
     */
    public function index(): void
    {
        /**
         * 
         * start filter
         * 
         */

        $search = filter_input(INPUT_GET, "search");
        $order = filter_input(INPUT_GET, "order");

        $rules = "";
        $ruleValues = "";
        if (!empty($search)) {
            $rules .= "MATCH(name) AGAINST(:name) AND ";
            $ruleValues .= "name={$search}&";
        }

        $orderBy = "created_at {$this->settings->listings->order_create_date}";
        if (!empty($order) && in_array($order, ["asc", "desc"])) {
            $orderBy = "created_at " . strtoupper($order);
        }

        $rules = !empty($rules) ? substr($rules, 0, strlen($rules) - 5) : null;
        $ruleValues = !empty($ruleValues) ? substr($ruleValues, 0, strlen($ruleValues) - 1) : null;

        /**
         * 
         * end filter
         * 
         */

        /** @var int */
        $page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT) ?? 1;

        /** @var Product */
        $products = (new Product())->limit($this->settings->listings->limit_items)->offset($page)->orderBy($orderBy)->find($rules, $ruleValues);

        $this->view("dash/products", [
            "pagination" => $products->paginate(),
            "products" => $products->get(true),
        ])->seo("Lista de produtos")->render();
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $this->view("dash/product-create")->seo("Cadastrar novo produto")->render();
    }

    /**
     * @return void
     */
    public function store(): void
    {
        $this->csrfVerify($_POST);

        $data = $_POST;
        $product = new Product();

        if (!$product->set($data)) {
            echo json_encode([
                "success" => false,
                "message" => message()->warning("Erro ao validar os dados informados. Verifique e tente de novo.")->float()->render(),
                "errors" => $product->errors()
            ]);
            return;
        }

        if (!$product->add()) {
            echo json_encode([
                "success" => false,
                "message" => message()->warning("Houve um erro interno ao tentar salvar dados.")->float()->render()
            ]);
            return;
        }

        message()->success("Um novo produto foi cadastrado! Agora você pode cadatrar lotes deste produto.")->float(12)->flash();
        echo json_encode([
            "success" => true,
            "redirect" => $this->route("dash.products")
        ]);
        return;
    }

    /**
     * @return void
     */
    public function edit(): void
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT) ?? 0;
        $product = (new Product())->find("id=:id", "id={$id}")->get();
        if (!$product) {
            message()->warning("O produto não foi encontrado ou já foi excluído.")->float()->flash();
            $this->router->redirect("dash.products");
            return;
        }

        $this->view("dash/product-edit", ["product" => $product])->seo("Editar produto")->render();
    }

    /**
     * @return void
     */
    public function update(): void
    {
        $this->csrfVerify($_POST);

        /** @var int */
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT) ?? 0;

        /** @var Product */
        $product = (new Product())->find("id=:id", "id={$id}")->get();

        if (!$product) {
            message()->warning("Atualização de produto que não existe ou que já foi excluído.")->float()->flash();
            echo json_encode([
                "success" => true,
                "redirect" => $this->route("dash.products")
            ]);
            return;
        }

        $data = $_POST;
        if (!$product->set($data)) {
            echo json_encode([
                "success" => false,
                "message" => message()->warning("Houve erros na validação dos dados, verifique e tente de novo.")->float()->render(),
                "errors" => $product->errors()
            ]);
            return;
        }

        $product->update();

        echo json_encode([
            "success" => true,
            "message" => message()->info("Este produto foi atualizado com sucesso.")->float()->render()
        ]);
        return;
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT) ?? 1;
        $product = (new Product())->find("id=:id", "id={$id}")->get();

        if (!$product) {
            message()->warning("O produto que você tentou excluir não existe ou já foi excluído.")->float()->flash();
            echo json_encode([
                "success" => false,
                "redirect" => $this->route("dash.products")
            ]);
            return;
        }

        $product->delete();

        message()->info("O produto foi excluído com sucesso.")->float()->flash();
        echo json_encode([
            "success" => false,
            "redirect" => $this->route("dash.products")
        ]);
        return;
    }

    /**
     * @return void
     */
    public function filter(): void
    {
        $page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT) ?? 1;
        $search = filter_input(INPUT_POST, "search");
        $order = filter_input(INPUT_POST, "order");

        $params = [];
        if (!empty($search))
            $params["search"] = $search;

        if (!empty($order) && in_array($order, ["asc", "desc"]))
            $params["order"] = $order;

        if (count($params) != 0 && $page)
            $params["page"] = $page;

        echo json_encode([
            "success" => true,
            "redirect" => $this->route("dash.products", $params)
        ]);
        return;
    }
}
