<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Elemento\Elemento;
use Elemento\SafeHtml;

Elemento::macro('notice', static function (string $message, string $kind = 'info') {
    $colours = [
        'info' => 'notice notice--info',
        'success' => 'notice notice--success',
        'danger' => 'notice notice--danger',
    ];

    return Elemento::div(['class' => $colours[$kind] ?? $colours['info']])
        ->add(Elemento::span(ucfirst($kind) . ': ')->addClass('notice__title'))
        ->add($message);
});

Elemento::macro('metric', static function (string $label, string $value, string $trend) {
    return Elemento::article(['class' => 'metric'])
        ->add(Elemento::span($label, ['class' => 'metric__label']))
        ->add(Elemento::h2($value, ['class' => 'metric__value']))
        ->add(Elemento::span($trend, ['class' => 'metric__trend']));
});

$content = Elemento::main(['class' => 'container'])
    ->add(Elemento::h1('Custom components'))
    ->add(Elemento::p('Macros turn your design decisions into small, reusable building blocks.'))
    ->add(Elemento::div(['class' => 'metrics'])->add([
        Elemento::callMacro('metric', ['Monthly revenue', '£12,480', '↑ 18.2% vs last month']),
        Elemento::callMacro('metric', ['Active teams', '284', '↑ 12 new this week']),
    ]))
    ->add(Elemento::div()->trustedHtml(new SafeHtml('<span class="check" aria-hidden="true">✓</span> Trusted, application-owned icon markup.')))
    ->add(Elemento::callMacro('notice', ['Your profile was saved.', 'success']))
    ->add(Elemento::callMacro('notice', ['Macros return normal Element instances.']));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Elemento components</title>
    <style>*{box-sizing:border-box}body{margin:0;background:#f6f8fc;color:#182033;font:16px/1.5 Inter,system-ui,sans-serif}.container{max-width:920px;margin:0 auto;padding:64px 24px}.container h1{font-size:clamp(2.25rem,5vw,4rem);margin:0}.container>p{color:#667085;font-size:1.1rem}.metrics{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;margin:32px 0}.metric{padding:24px;background:#182033;color:#fff;border-radius:18px}.metric__label,.metric__trend{display:block;color:#b8c2dc}.metric__value{margin:8px 0;font-size:2.2rem}.metric__trend{color:#7ee2b8}.notice{padding:16px 18px;margin:16px 0;border-radius:12px}.notice--info{background:#e0edff}.notice--success{background:#dcfce7}.notice--danger{background:#fee2e2}.check{display:inline-grid;place-items:center;width:24px;height:24px;border-radius:50%;background:#16213c;color:#8cf0bf;font-weight:800}@media(max-width:600px){.metrics{grid-template-columns:1fr}}</style>
</head>
<body><?= $content ?></body>
</html>
