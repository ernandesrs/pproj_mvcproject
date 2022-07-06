<?= $v->layout("layouts/dash") ?>

<?= $v->start("content") ?>

<div class="section products-section">
    <?php

    $headerButtons = [
        "phButtonOne" => [
            "type" => "link",
            "text" => "Novo produto",
            "style" => "success",
            "link" => $router->route("dash.products.create"),
            "activeIcon" => icon_class("plusLg"),
            "altIcon" => icon_class("loading"),
        ],
        "phButtonTwo" => [
            "type" => "button",
            "text" => "Exemplo",
            "style" => "secondary",
            "link" => "#link",
            "activeIcon" => icon_class("pieChart"),
            "altIcon" => icon_class("loading"),
        ]
    ];

    $filterFormActionLink = $router->route("dash.products.filter");

    include __DIR__ . "/includes/page-header.php";

    ?>

    <div class="section-content py-3">
        <?php if ($products ?? null) : ?>
            <div class="table-responsive">
                <table class="table table-sm table-hover table-borderless rounded">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Nome</th>
                            <th>Modo de compra</th>
                            <th>Modo de venda</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /** @var \App\Models\Product $product */
                        foreach ($products as $product) : ?>
                            <tr>
                                <td class="align-middle font-weight-bold text-center">
                                    #<?= $product->id ?>
                                </td>
                                <td class="align-middle">
                                    <?= $product->name ?>
                                </td>
                                <td class="align-middle">
                                    <?= get_term("product.purchase_mode.purchase_{$product->purchase_mode}") ?>
                                </td>
                                <td class="align-middle">
                                    <?= get_term("product.sale_mode.sale_{$product->sale_mode}") ?>
                                </td>
                                <td class="align-middle">
                                    <a class="btn btn-info" href="<?= $router->route("dash.products.edit", ["id" => $product->id]) ?>">
                                        <?= icon_elem("pencilSquare") ?>
                                    </a>
                                    <button class="btn btn-outline-danger jsConfirmationModalButton" data-action="<?= $router->route("dash.products.delete", ["id" => $product->id]) ?>" data-style="danger" data-message="Você está excluindo um produto e isso não pode ser desfeito, confirme para continuar.">
                                        <?= icon_elem("trash") ?>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <?php include __DIR__ . "/includes/alert-empty-list.php" ?>
        <?php endif; ?>
    </div>

    <div class="section-footer pt-3">
        <!-- pagination -->
        <?php include __DIR__ . "/includes/pagination.php" ?>
    </div>
</div>


<?= $v->end("content") ?>

<?= $v->start("modals") ?>

<?php include __DIR__ . "/../includes/modal-confirmation.php" ?>

<?= $v->end("modals") ?>