<div class="section-header row">
    <div class="left-side col-12 col-lg-6 d-flex align-items-center">
        <div>
            <h2 class="title"><?= $pageTitle ?? $seo->title ?></h2>
            <?php if ($pageSubtitle ?? null) : ?>
                <p class="mb-0"><?= $pageSubtitle ?></p>
            <?php endif; ?>
        </div>

        <?php $i = 0;
        foreach ($headerButtons ?? [] as $kHeaderButton => $headerButton) : ?>
            <?php if ($headerButton["type"] == "link") : ?>
                <a class="btn btn-<?= $headerButton["style"] ?> <?= $i == 0 ? "ml-auto" : "ml-2" ?> ml-lg-2 <?= $kHeaderButton ?>" href="<?= $headerButton["link"] ?>" id="<?= $kHeaderButton ?>">
                    <i class="icon <?= $headerButton["activeIcon"] ?>"></i> <?= $headerButton["text"] ?>
                </a>
            <?php else : ?>
                <button class="btn btn-<?= $headerButton["style"] ?> <?= $i == 0 ? "ml-auto" : "ml-2" ?> ml-lg-2 <?= $kHeaderButton ?> <?= $headerButton["activeIcon"] ?>" data-active-icon="<?= $headerButton["activeIcon"] ?>" data-alt-icon="<?= $headerButton["altIcon"] ?>" data-action="<?= $headerButton["link"] ?>" id="<?= $kHeaderButton ?>">
                    <?= $headerButton["text"] ?>
                </button>
            <?php endif; ?>
        <?php $i++;
        endforeach; ?>
    </div>

    <div class="right-side col-12 col-lg-6 d-flex align-items-center mt-3 mt-lg-0">
        <?php if ($filterFormActionLink ?? null) : ?>
            <div class="filter-bar w-100">
                <form action="<?= $filterFormActionLink ?>" method="post">
                    <div class="d-flex justify-content-center justify-content-lg-end align-items-center">
                        <!-- order input -->
                        <div class="form-group ml-2">
                            <label for="order">Data de criação:</label>
                            <select class="form-control form-control-sm text-center" name="order" id="order">
                                <option value="none">Ordem</option>
                                <option value="asc" <?= input_value("order", $_GET) == "asc" ? "selected" : null ?>>Crescente</option>
                                <option value="desc" <?= input_value("order", $_GET) == "desc" ? "selected" : null ?>>Decrescente</option>
                            </select>
                        </div>

                        <!-- search input -->
                        <div class="form-group ml-2">
                            <label for="search">Buscar:</label>
                            <input class="form-control form-control-sm text-center" type="search" name="search" id="search" placeholder="Buscar" value="<?= input_value("search", $_GET) ?>">
                        </div>

                        <!-- submit button -->
                        <button class="btn bg-transparent <?= icon_class("funnel") ?>" data-active-icon="<?= icon_class("funnel") ?>" data-alt-icon="<?= icon_class("loading") ?>"></button>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>