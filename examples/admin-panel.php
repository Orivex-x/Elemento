<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Elemento\Elemento;
use Elemento\DataBinding\DataBinder;
use Elemento\Theme\TailwindTheme;

Elemento::setTheme(new TailwindTheme());

$data = [
    'users' => [
    ['name' => 'Ada Lovelace', 'role' => 'Administrator'],
    ['name' => 'Grace Hopper', 'role' => 'Editor'],
    ],
];
$users = DataBinder::getValue($data, 'users', []);

$table = Elemento::table()->addClass('min-w-full overflow-hidden bg-white shadow-sm ring-1 ring-slate-200 rounded-2xl');
$table->add(Elemento::thead(['class' => 'bg-slate-50'])->add(Elemento::tr()->add([
    Elemento::th('Member')->addClass('px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500'),
    Elemento::th('Role')->addClass('px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500'),
])));
$body = Elemento::tbody();

foreach ($users as $user) {
    $body->add(
        Elemento::tr()->add([
            Elemento::td($user['name'])->addClass('px-6 py-4 font-semibold text-slate-800'),
            Elemento::td()->add(Elemento::span($user['role'])->addClass('rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700')),
        ])
    );
}

$table->add($body);

$panel = Elemento::main(['class' => 'mx-auto max-w-6xl p-6 lg:p-10'])
    ->add(Elemento::header(['class' => 'mb-10 flex items-end justify-between'])->add([
        Elemento::div()->add([
            Elemento::span('TEAM MANAGEMENT')->addClass('text-sm font-bold tracking-widest text-indigo-600'),
            Elemento::h1('People, permissions, and momentum')->addClass('mt-2 text-4xl font-bold tracking-tight text-slate-900'),
            Elemento::p('Keep the right people moving on the right work.')->addClass('mt-3 text-lg text-slate-500'),
        ]),
        Elemento::buttonThemed('Invite member')->addClass('hidden sm:block'),
    ]))
    ->add(Elemento::alert('User data was refreshed.', 'success'))
    ->add(Elemento::div(['class' => 'mb-6 grid gap-4 md:grid-cols-3'])->add([
        Elemento::card('Active members', '284 across 19 teams'),
        Elemento::card('Pending invites', '6 awaiting a response'),
        Elemento::card('Access reviews', '2 need attention'),
    ]))
    ->add($table);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Elemento · Team administration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100"><?= $panel ?></body>
</html>
