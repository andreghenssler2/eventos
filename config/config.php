<?php

date_default_timezone_set('America/Sao_Paulo');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APP_NAME', 'EventSys');
define('APP_URL', 'http://localhost');

require_once __DIR__ . '/database.php';
// require_once __DIR__ . '/../mod/auth/Middleware.php';
require_once __DIR__ . '/../mod/auth/Session.php';

require_once __DIR__ . '/../mod/Helper.php';
require_once __DIR__ . '/../lib/vendor/autoload.php';

require_once __DIR__.'/../mod/event/Evento.php';
