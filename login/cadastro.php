<?php

require_once '../config/config.php';
require_once '../mod/auth/Auth.php';
require_once '../mod/auth/Session.php';
require_once '../mod/auth/Middleware.php';
require_once '../mod\auth\Usario.php';

Middleware::guest();

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Session::validateCsrf($_POST['_token'] ?? '')) {
        $erro = 'Token inválido.';
    } else {

        $usuario = new Usuario();

        if ($usuario->emailExiste($_POST['email'])) {

            $erro = 'Este e-mail já está cadastrado.';

        } elseif ($_POST['senha'] != $_POST['senha2']) {

            $erro = 'As senhas não conferem.';

        } else {

            $id = $usuario->cadastrar([
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => $_POST['senha'],
                'tipo' => '3',
                'ativo' => 1
            ]);

            // aqui será criado o participante

            header("Location: login.php?cadastro=1");
            exit;
        }

    }

}
?>
<!doctype html>

<html lang="pt-BR">

<head>

    <meta charset="utf-8">

    <title>Criar Conta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../public/css/login.css">

</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="card shadow">

                    <div class="card-header bg-primary text-white">

                        <h3 class="mb-0">

                            Criar Conta

                        </h3>

                    </div>

                    <div class="card-body">

                        <?php if ($erro) { ?>

                            <div class="alert alert-danger">

                                <?= $erro ?>

                            </div>

                        <?php } ?>

                        <form method="POST">

                            <input type="hidden" name="_token" value="<?= Session::csrf() ?>">

                            <h5 class="mb-3">

                                Dados Pessoais

                            </h5>

                            <div class="row">

                                <div class="col-md-8 mb-3">

                                    <label>Nome Completo</label>

                                    <input class="form-control" name="nome" required>

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>CPF</label>

                                    <input class="form-control" name="cpf">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>Data de Nascimento</label>

                                    <input type="date" class="form-control" name="nascimento">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>Sexo</label>

                                    <select class="form-select" name="sexo">

                                        <option value="">Selecione</option>

                                        <option>Masculino</option>

                                        <option>Feminino</option>

                                        <option>Outro</option>

                                    </select>

                                </div>

                            </div>

                            <hr>

                            <h5>

                                Contato

                            </h5>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label>E-mail</label>

                                    <input type="email" class="form-control" name="email" required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>Confirmar E-mail</label>

                                    <input type="email" class="form-control" name="email2" required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>WhatsApp</label>

                                    <input class="form-control" name="whatsapp">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>Telefone</label>

                                    <input class="form-control" name="telefone">

                                </div>

                            </div>

                            <hr>

                            <h5>

                                Endereço

                            </h5>

                            <div class="row">

                                <div class="col-md-2 mb-3">

                                    <label>CEP</label>

                                    <input class="form-control" name="cep">

                                </div>

                                <div class="col-md-8 mb-3">

                                    <label>Rua</label>

                                    <input class="form-control" name="rua">

                                </div>

                                <div class="col-md-2 mb-3">

                                    <label>Número</label>

                                    <input class="form-control" name="numero">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>Bairro</label>

                                    <input class="form-control" name="bairro">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>Cidade</label>

                                    <input class="form-control" name="cidade">

                                </div>

                                <div class="col-md-4 mb-3">

                                    <label>Estado</label>

                                    <input class="form-control" name="estado">

                                </div>

                            </div>

                            <hr>

                            <h5>

                                Login

                            </h5>

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label>Senha</label>

                                    <input type="password" class="form-control" name="senha" required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>Confirmar Senha</label>

                                    <input type="password" class="form-control" name="senha2" required>

                                </div>

                            </div>

                            <div class="form-check mb-4">

                                <input class="form-check-input" type="checkbox" required>

                                <label class="form-check-label">

                                    Aceito os termos de uso.

                                </label>

                            </div>

                            <div class="text-end">

                                <a href="login.php" class="btn btn-secondary">

                                    Cancelar

                                </a>

                                <button class="btn btn-primary">

                                    <i class="bi bi-person-plus"></i>

                                    Criar Conta

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>