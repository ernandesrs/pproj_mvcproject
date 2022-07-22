<?php
$skills = [
    (object)[
        "title" => "HTML5",
        "percent" => 92,
    ],
    (object)[
        "title" => "CSS3/Bootstrap/Sass",
        "percent" => 90,
    ],
    (object)[
        "title" => "JavaScript/jQuery/Vue",
        "percent" => 82,
    ],
    (object)[
        "title" => "PHP/Laravel",
        "percent" => 96,
    ],
    (object)[
        "title" => "Banco de dados MySQL",
        "percent" => 96,
    ],
];

$projects = [
    (object)[
        "title" => "PROJECT 1 LOREM",
        "description" => "Apresentação rápida do projeto e de tecnologias utilizadas.",
        "url" => "",
        "image" => "public/assets/images/project_01.jpg",
    ],
    (object)[
        "title" => "PROJECT 2 LOREM",
        "description" => "Apresentação rápida do projeto e de tecnologias utilizadas.",
        "url" => "",
        "image" => "public/assets/images/project_01.jpg",
    ],
    (object)[
        "title" => "PROJECT 3 LOREM",
        "description" => "Apresentação rápida do projeto e de tecnologias utilizadas.",
        "url" => "",
        "image" => "public/assets/images/project_01.jpg",
    ],
    (object)[
        "title" => "PROJECT 4 LOREM",
        "description" => "Apresentação rápida do projeto e de tecnologias utilizadas.",
        "url" => "",
        "image" => "public/assets/images/project_01.jpg",
    ],
    (object)[
        "title" => "PROJECT 5 LOREM",
        "description" => "Apresentação rápida do projeto e de tecnologias utilizadas.",
        "url" => "",
        "image" => "public/assets/images/project_01.jpg",
    ],
    (object)[
        "title" => "PROJECT 6 LOREM",
        "description" => "Apresentação rápida do projeto e de tecnologias utilizadas.",
        "url" => "",
        "image" => "public/assets/images/project_01.jpg",
    ],
];
?>
<?= $v->layout("layouts/front") ?>

<?= $v->start("content") ?>

<div id="slide" class="section slide">
    <div class="section-inner slide-inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-10 col-lg-8">
                    <h2 class="suptitle">Fulano de Tal</h2>
                    <h1 class="title">Desenvolvedor fullstack de soluções web</h1>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <div class="buttons">
                        <a class="btn btn-primary" href="">Solicitar orçamento</a>
                        <a class="btn btn-secondary-light" href="">Portfólio</a>
                        <a class="btn btn-secondary-light" href="">Conhecer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="skill" class="section skill">
    <div class="section-inner skill-inner">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    <h1 class="title">Olá, me chamo Lorem Ipsum!</h1>
                    <p class="description">
                        Sou programador web, possuo habilidades em programação backend e
                        frontend. In sem justo, commodo ut, suscipit at, pharetra vitae, orci duis
                        sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor.
                    </p>
                    <p class="description">
                        In sem justo, commodo ut, suscipit at, pharetra vitae, orci duis sapien
                        nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Vitae, orcidis
                        sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor.
                    </p>
                    <h2 class="subtitle">HABILIDADES PRINCIPAIS</h2>
                    <p class="description">As seguintes linguagens compõem meu pacote de habilidades.</p>
                    <ul class="skill-list">
                        <?php foreach ($skills as $skill) : $skill = (object) $skill; ?>
                            <li class="skill-list-item">
                                <div class="percent" style="width: <?= $skill->percent ?>%;"></div>
                                <span class="text"><?= $skill->title ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="py-3">
                        <h2 class="pb-2 subtitle subtitle-2">Vamos conversar sobre seu projeto?</h2>
                        <div class="buttons">
                            <a class="btn btn-primary" href="">Entrar em contato</a>
                            <a class="btn btn-secondary-light" href="#portfolio">Ver portfólio</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="portfolio" class="section portfolio">
    <div class="section-inner portfolio-inner">
        <div class="container-fluid">
            <h1 class="title">PORTFÓLIO</h1>
            <div class="row justify-content-center projects-list">
                <?php foreach ($projects as $project) : ?>
                    <div class="col-sm-6 col-md-4 mb-4 projects-list-item">
                        <div class="inner">
                            <img class="img-fluid" src="<?= url($project->image) ?>" alt="">
                            <div class="project-info">
                                <a href="<?= $project->url ?>" target="_blank">
                                    <h2 class="title"><?= $project->title ?></h2>
                                    <p class="description"><?= $project->description ?></p>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?= $v->end("content") ?>