<?= $v->layout("layouts/dash") ?>

<?= $v->start("content") ?>

<div class="section section-settings">
    <div class="section-header">
        <div class="left-side">
            <h2 class="title">Configurações</h2>
        </div>
        <div class="right-side">
        </div>
    </div>

    <div class="section-content">
        <div class="py-3">
            <h5>Configurações do dashboard</h5>
            <hr>
            <div>
                <form action="<?= $router->route("dash.settings", ["apply" => true]) ?>">
                    <div class="form-row">

                        <div class="col-12">
                            <fieldset>
                                <legend>Tema:</legend>
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="dark_mode" name="dark_mode">Modo escuro:</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="dark_mode" name="dark_mode" <?= $dash_settings->theme->dark_mode ? "checked" : null ?>>
                                                <label class="custom-control-label" for="dark_mode" name="dark_mode"><?= $dash_settings->theme->dark_mode ? "Desativar" : "Ativar" ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-12">
                            <fieldset>
                                <legend>Listagens:</legend>
                                <div class="form-row">
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="limit_items">Limite de itens nas listas:</label>
                                            <input class="form-control" type="text" name="limit_items" id="limit_items" value="<?= $dash_settings->listings->limit_items ?>">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label for="order_create_date">Ordenação padrão:</label>
                                            <select class="form-control" name="order_create_date" id="order_create_date">
                                                <option value="desc" <?= $dash_settings->listings->order_create_date == "desc" ? "selected" : null ?>>Decrescente</option>
                                                <option value="asc" <?= $dash_settings->listings->order_create_date == "asc" ? "selected" : null ?>>Crescente</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 text-right">
                                        <button class="btn btn-primary <?= icon_class("checkLg") ?>" data-active-icon="<?= icon_class("checkLg") ?>" data-alt-icon=" <?= icon_class("loading") ?>">
                                            Salvar configurações
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $v->end("content") ?>