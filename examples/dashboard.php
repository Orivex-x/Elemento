<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Elemento\Elemento;
use Elemento\Theme\BootstrapTheme;

Elemento::setTheme(new BootstrapTheme());

$dashboard = Elemento::main(['class' => 'container py-5'])
    ->add(Elemento::header(['class' => 'd-flex justify-content-between align-items-end mb-5'])->add([
        Elemento::div()->add([Elemento::span('OVERVIEW')->addClass('text-primary fw-bold small'), Elemento::h1('Good morning, Ada')->addClass('display-6 mb-0')]),
        Elemento::buttonThemed('Create report'),
    ]))
    ->add(Elemento::alert('Three reports are ready for review.'))
    ->add(Elemento::div(['class' => 'row g-4 mb-4'])->add([
        Elemento::div(['class' => 'col-md-4'])->add(Elemento::card('Monthly revenue', '£12,480 · ↑ 18.2%')),
        Elemento::div(['class' => 'col-md-4'])->add(Elemento::card('Active teams', '284 · ↑ 12 this week')),
        Elemento::div(['class' => 'col-md-4'])->add(Elemento::card('Uptime', '99.99% · All systems normal')),
    ]))
    ->add(
        Elemento::table(['class' => 'table'])
            ->add(
                Elemento::thead()->add(
                    Elemento::tr()->add([
                        Elemento::th('Report'),
                        Elemento::th('Status'),
                    ])
                )
            )
            ->add(
                Elemento::tbody()->add(
                    Elemento::tr()->add([
                        Elemento::td('June sales performance'),
                        Elemento::td()->add(Elemento::badge('Ready to review', 'success')),
                    ])
                )
            )
    );
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Elemento · Product dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-body-tertiary"><?= $dashboard ?></body>
</html>
