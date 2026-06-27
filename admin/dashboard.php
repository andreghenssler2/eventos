<?php

require_once '../config/config.php';

require_once '../mod/auth/Auth.php';
require_once '../mod/auth/Middleware.php';

Middleware::admin();

$usuario = Auth::user();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Painel Administrativo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-dark bg-dark">

        <div class="container-fluid">

            <span class="navbar-brand">

                Painel Administrativo

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

        <div class="row">

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        Eventos

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        Participantes

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        Inscrições

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        Certificados

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>