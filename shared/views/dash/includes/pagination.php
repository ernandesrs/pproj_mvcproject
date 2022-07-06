<?php if (($pagination ?? null) && $pagination->pages > 1) : ?>
    <div class="d-flex justify-content-end align-items-center">
        <span class="font-weight-bold text-dark-light mr-3">
            Paginação:
        </span>
        <ul class="pagination mb-0">
            <?php for ($i = 0; $i < $pagination->pages; $i++) : ?>
                <li class="page-item <?= $pagination->currentPage == ($i + 1) ? "disabled" : null ?>">
                    <a class="page-link" href="<?= $router->route($router->currentRouteName(), array_merge(url_params(["page"]) ?? [], ["page" => ($i + 1)])) ?>" tabindex="-1">
                        <?= ($i + 1) ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
<?php endif; ?>