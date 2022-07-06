<?= $v->layout("layouts/dash") ?>

<?= $v->start("content") ?>

<div class="section section-overview">
    <!-- page header -->
    <?php

    $pageTitle = "Visão geral";

    include __DIR__ . "/includes/page-header.php";

    ?>

    <div class="section-content border-0 bg-transparent">
        <div class="row justify-content-center overview-boxes-list">
            <?php if (($overviewBoxes ?? null)) :
                $totalBoxes = count($overviewBoxes);
                foreach ($overviewBoxes as $boxe) :
                    $boxeItem = "
                    <div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-4'>
                        <div class='card card-body px-3 py-3 border-0 shadow d-flex flex-row align-items-center overview-boxes-item'>
                            <i class='{$boxe->icon}'></i>
                            <div class='w-100'>
                                <h5 class='mb-0 title'>
                                    {$boxe->text}
                                </h5>
                                <div class='d-flex align-items-center'>
                                    <p class='mb-0 total'>
                                        <span>Total:</span> <span class='value'>{$boxe->total}</span>
                                    </p>
                                    <a class='btn btn-sm btn-link ml-auto' href='{$boxe->link}'>
                                        Acessar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>"; ?>
                    <?php if (!($boxe->visible_to ?? null)) : ?>
                        <?= $boxeItem ?>
                    <?php elseif (in_array($logged->level, $boxe->visible_to)) : ?>
                        <?= $boxeItem ?>
                    <?php endif; ?>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12 <?= ($reports ?? null) ? "col-md-6 col-lg-7" : null ?>">
        <div class="section section-overview">
            <!-- page header -->
            <?php

            $pageTitle = "Um gráfico cairia bem aqui";
            $pageSubtitle = "Poderia ter um gráfico maneiro aqui embaixo";
            $headerButtons = [
                "phButtonOne" => [
                    "type" => "link",
                    "text" => "Mais detalhes",
                    "style" => "info btn-link",
                    "link" => $router->route("dash.products"),
                    "activeIcon" => "",
                    "altIcon" => "",
                ]
            ];

            include __DIR__ . "/includes/page-secondary-header.php";

            ?>

            <div class="section-content">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <?php if ($reports ?? null) : ?>
        <div class="col-12 col-md-6 col-lg-5">
            <div class="section section-overview">
                <!-- page header -->
                <?php

                $pageTitle = "Últimas atividades";
                $pageSubtitle = "Últimas atividades registradas no dashboard";
                $headerButtons = null;

                include __DIR__ . "/includes/page-secondary-header.php";

                ?>

                <div class="section-content">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless table-hover jsReportsTable">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Última atividade</th>
                                    <th>Página</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reports ?? [] as $report) :
                                    $last = $report->lastActivityReport(); ?>
                                    <tr id="report<?= $last->id ?? null ?>">
                                        <td class="align-middle username">
                                            <?= $report->username ?>
                                        </td>
                                        <td class="align-middle last-report">
                                            <?= ($last ?? null) ? App\Helpers\Date::hoursElapsedSoFar($last->last_report) : "Nunca ativo" ?>
                                        </td>
                                        <td class="align-middle text-nowrap d-inline-block text-truncate last-page" style="width: 100%; max-width: 150px;">
                                            <?php if ($last) : ?>
                                                <a href="<?= url($last->last_page) ?>" target="_blank">
                                                    <?= $last->last_page ?>
                                                </a>
                                            <?php else : ?>
                                                Nenhuma visita
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>


<?= $v->end("content") ?>

<?= $v->start("scripts") ?>

<script src="<?= asset("js/chart.min.js") ?>"></script>
<script>
    const labels = [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Linha 1',
            backgroundColor: 'rgb(217, 120, 130)',
            borderColor: 'rgb(217, 120, 130)',
            data: [5, 10, 15, 20, 25, 20],
        }, {
            label: 'Linha 2',
            backgroundColor: 'rgb(210, 210, 210)',
            borderColor: 'rgb(210, 210, 210)',
            data: [10, 15, 20, 15, 20, 10],
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

<?= $v->end("scripts") ?>