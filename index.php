<?php

require_once 'config/config.php';

$evento = new Evento();

$eventos = $evento->listarDestaques();

include 'resources/layouts/header.php';
include 'resources/layouts/navbar.php';
?>

<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="display-4 fw-bold">

                    Sistema de Eventos

                </h1>

                <p class="lead">

                    Gerencie inscrições, pagamentos e certificados em um único lugar.

                </p>

                <a href="#" class="btn btn-primary btn-lg">

                    Ver Eventos

                </a>

            </div>

            <div class="col-lg-6 text-center">

                <img src="public/img/banner.png" class="img-fluid">

            </div>

        </div>

    </div>

</section>

<?php

include 'resources/layouts/footer.php';

?>