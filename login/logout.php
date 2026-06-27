<?php

require_once '../config/config.php';
require_once '../mod/auth/Auth.php';

Auth::logout();

header("Location: login.php");

exit;