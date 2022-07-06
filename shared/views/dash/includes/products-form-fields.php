<div class="form-row py-3">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Nome do produto:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= input_value("name", $product ?? null) ?>">
        </div>
    </div>

    <?php

    $purchaseModes = \App\Models\Product::PURCHASE_MODES;
    $saleModes = \App\Models\Product::SALE_MODES;

    ?>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label for="purchase_mode">Modo de compra:</label>
            <select class="form-control" name="purchase_mode" id="purchase_mode">
                <option>Selecione</option>
                <?php foreach ($purchaseModes as $pm) : ?>
                    <option value="<?= $pm ?>" <?= input_value("purchase_mode", $product ?? null) == $pm ? "selected" : null ?>>
                        <?= get_term("product.purchase_mode.purchase_{$pm}") ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label for="sale_mode">Modo de venda:</label>
            <select class="form-control" name="sale_mode" id="sale_mode" value="<?= input_value("sale_mode", $product ?? null) ?>">
                <option>Selecione</option>
                <?php foreach ($saleModes as $sm) : ?>
                    <option value="<?= $sm ?>" <?= input_value("sale_mode", $product ?? null) == $sm ? "selected" : null ?>>
                        <?= get_term("product.sale_mode.sale_{$sm}") ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>