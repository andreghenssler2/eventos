<?php

require_once '../config/config.php';
require_once '../mod/auth/Auth.php';
require_once '../mod/auth/Session.php';
require_once '../mod/auth/Middleware.php';

Middleware::guest();

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Session::validateCsrf($_POST['_token'] ?? '')) {

        $erro = 'Token de segurança inválido.';

    } else {

        $auth = new Auth();

        if ($auth->login($_POST['email'], $_POST['senha'])) {

            Auth::redirectDashboard();

        } else {

            $erro = 'E-mail ou senha inválidos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Entrar - EventSys</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../public/css/login.css">

</head>

<body>

    <div class="container-fluid">

        <div class="row vh-100">

            <div class="col-lg-7 d-none d-lg-flex bg-login">

                <div class="overlay">

                    <div>

                        <h1>EventSys</h1>

                        <p class="lead">
                            Sistema completo para gerenciamento de eventos,
                            inscrições e certificados.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-lg-5 d-flex align-items-center justify-content-center">

                <div class="login-box">

                    <div class="text-center mb-4">

                        <h2>Entrar</h2>

                        <p class="text-muted">
                            Acesse sua conta
                        </p>

                    </div>

                    <?php if ($erro) { ?>

                        <div class="alert alert-danger">

                            <?= $erro ?>

                        </div>

                    <?php } ?>

                    <form method="POST">

                        <input type="hidden" name="_token" value="<?= Session::csrf() ?>">

                        <div class="mb-3">

                            <label>E-mail</label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i class="bi bi-envelope"></i>

                                </span>

                                <input type="email" name="email" class="form-control" required>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label>Senha</label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i class="bi bi-lock"></i>

                                </span>

                                <input type="password" name="senha" class="form-control" required>

                            </div>

                        </div>

                        <div class="form-check mb-3">

                            <input type="checkbox" class="form-check-input" name="remember">

                            <label class="form-check-label">

                                Lembrar-me

                            </label>

                        </div>

                        <button class="btn btn-primary w-100">

                            Entrar

                        </button>

                        <div class="text-center mt-4">

                            <a href="recuperar.php">

                                Esqueci minha senha

                            </a>

                            <br>

                            <a href="cadastro.php">

                                Criar Conta

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>