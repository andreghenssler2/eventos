<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../mod/auth/Middleware.php';

Middleware::auth();

$pageTitle = $pageTitle ?? APP_NAME;
$content = $content ?? '';

include __DIR__ . '/header.php';
?>

<div id="wrapper">

    <?php include __DIR__ . '/sidebar.php'; ?>

    <div id="content">

        <?php include __DIR__ . '/topbar.php'; ?>

        <main class="container-fluid py-4">

            <?php

            if (file_exists($content)) {
                include $content;
            } else {
                echo '<div class="alert alert-danger">';
                echo 'Página não encontrada.';
                echo '</div>';
            }

            ?>

        </main>

        <?php include __DIR__ . '/footer.php'; ?>

    </div>

</div>

<?php include __DIR__ . '/scripts.php'; ?>