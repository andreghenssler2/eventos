<?php

$user = Auth::user();

?>

<nav class="topbar">

    <div class="left">

        <button id="btnMenu" class="btn btn-light">

            <i class="bi bi-list"></i>

        </button>

        <h5>

            <?= $pageTitle ?>

        </h5>

    </div>

    <div class="right">

        <div class="dropdown">

            <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown">

                <i class="bi bi-person-circle"></i>

                <?= htmlspecialchars($user['nome']) ?>

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <a class="dropdown-item" href="/perfil.php">

                        Meu Perfil

                    </a>

                </li>

                <li>
                    <hr>
                </li>

                <li>

                    <a class="dropdown-item text-danger" href="/logout.php">

                        Sair

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>