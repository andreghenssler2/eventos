<?php

require_once '../config/config.php';

require_once '../mod/auth/Auth.php';
require_once '../mod/auth/Middleware.php';

Middleware::participante();

$usuario = Auth::user();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Minha Área</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-dark bg-primary">

        <div class="container-fluid">

            <span class="navbar-brand">

                Minha Área

            </span>

            <div>

                <?= htmlspecialchars($usuario['nome']) ?>

                <a href="../logout.php" class="btn btn-danger btn-sm ms-3">

                    Sair

                </a>

            </div>

        </div>

    </nav>

    <div class="container mt-5">

        <h3>Bem-vindo, <?= htmlspecialchars($usuario['nome']) ?></h3>

        <p>Em breve você poderá visualizar:</p>

        <ul>

            <li>Meus Eventos</li>

            <li>Minhas Inscrições</li>

            <li>Pagamentos</li>

            <li>Certificados</li>

            <li>Meu Perfil</li>

        </ul>

    </div>

</body>

</html>