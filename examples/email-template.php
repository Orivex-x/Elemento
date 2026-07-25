<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Elemento\Elemento;

$recipient = 'Ada';
$actionUrl = 'https://example.test/account';

$email = Elemento::table([
    'role' => 'presentation',
    'width' => '100%',
    'cellpadding' => 0,
    'cellspacing' => 0,
    'style' => 'font-family:Arial,sans-serif;background:#f4f4f5;padding:24px;',
])->add(
    Elemento::tbody()->add(
        Elemento::tr()->add(
            Elemento::td('', ['style' => 'max-width:600px;padding:0;background:#ffffff;border-radius:16px;overflow:hidden;'])
                ->add(Elemento::div(['style' => 'padding:32px;background:#172554;color:#ffffff;'])->add([
                    Elemento::span('Elemento / Weekly')->addClass('eyebrow'),
                    Elemento::h1('Your work is moving forward', ['style' => 'margin:12px 0 0;color:#ffffff;font-size:30px;']),
                ]))
                ->add(Elemento::div(['style' => 'padding:32px;'])->add([
                    Elemento::p("Hello $recipient,", ['style' => 'font-size:18px;font-weight:bold;']),
                    Elemento::p('Your workspace had a strong week. Three new reports are ready, your release checklist is complete, and your team shipped 18 improvements.'),
                    Elemento::div(['style' => 'margin:24px 0;padding:18px;background:#eef2ff;border-radius:10px;color:#312e81;'])->add('This week: 99.99% uptime · 284 active teams · 18 improvements shipped'),
                ]))
                ->add(
                    Elemento::a('View your account', $actionUrl, [
                        'style' => 'display:inline-block;padding:12px 18px;background:#2563eb;color:#ffffff;text-decoration:none;border-radius:4px;',
                    ])
                )
                ->add(Elemento::p('You received this message because you have an Elemento account.', ['style' => 'padding:0 32px 32px;color:#64748b;font-size:13px;']))
        )
    )
);
?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><title>Elemento email template</title></head>
<body><?= $email ?></body>
</html>
