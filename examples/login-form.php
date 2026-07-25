<?php

declare(strict_types=1);

session_start();

require dirname(__DIR__) . '/vendor/autoload.php';

use Elemento\Elemento;

$form = Elemento::postForm('/login-form.php', ['class' => 'auth-form'])
    ->withCSRFToken(Elemento::csrf())
    ->setRenderOptions([
        'wrapper_class' => 'field',
        'error_class' => 'field-error',
        'help_class' => 'field-help',
    ]);

$form->field('email', 'email', [
        'label' => 'Email address',
        'placeholder' => 'you@example.test',
        'required' => true,
    ]);

$form->field('password', 'password', [
    'label' => 'Password',
    'required' => true,
]);

$form->add(Elemento::button('Sign in securely')->submit()->addClass('submit-button'));

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    if (!Elemento::verifyCsrf($_POST['_token'] ?? '')) {
        $form->setErrors(['email' => 'Your session has expired. Please try again.']);
    } else {
        $form->bindData(['email' => $_POST['email'] ?? '']);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elemento · Secure sign in</title>
    <style>
        *{box-sizing:border-box}body{margin:0;min-height:100vh;display:grid;place-items:center;background:radial-gradient(circle at top,#263b70,#10182f 58%);font:16px/1.5 Inter,system-ui,sans-serif;color:#17203a}.auth-shell{width:min(100% - 32px,460px);padding:40px;background:#fff;border-radius:24px;box-shadow:0 28px 80px #0006}.eyebrow{color:#5b6df6;font-size:.78rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase}.auth-shell h1{margin:10px 0 8px;font-size:2rem}.auth-shell p{margin:0 0 28px;color:#667085}.field{margin:0 0 18px}.field label{display:block;margin-bottom:7px;font-weight:700}.field input{width:100%;padding:13px 14px;border:1px solid #d7dcea;border-radius:10px;font:inherit}.field input:focus{outline:3px solid #dfe3ff;border-color:#6474f5}.submit-button{width:100%;border:0;border-radius:10px;padding:14px;background:#5364ee;color:white;font:inherit;font-size:1rem;font-weight:700;cursor:pointer}.field-error{margin-top:8px;color:#b42318}.footer-note{margin-top:22px!important;text-align:center;font-size:.875rem}
    </style>
</head>
<body>
<main class="auth-shell">
    <div class="eyebrow">Elemento workspace</div>
    <h1>Welcome back</h1>
    <p>Sign in to review your releases, team activity, and deployment health.</p>
    <?= $form ?>
    <p class="footer-note">Protected with a server-side CSRF token.</p>
</main>
</body>
</html>
