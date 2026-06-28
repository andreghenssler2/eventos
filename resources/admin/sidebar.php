<?php

$menu = include __DIR__ . '/menu.php';

?>

<aside id="sidebar">

    <div class="logo">

        <h3>EventSys</h3>

    </div>

    <ul>

        <?php foreach ($menu as $item) { ?>

            <li>

                <a href="<?= $item['url'] ?>">

                    <i class="bi bi-<?= $item['icon'] ?>"></i>

                    <span>

                        <?= $item['title'] ?>

                    </span>

                </a>

            </li>

        <?php } ?>

    </ul>

</aside>