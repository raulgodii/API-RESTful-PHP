<?php
session_start();

use Routes\Routes;

require_once '../vendor/autoload.php';
require_once '../config/config.php';

$dotendv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotendv->safeLoad();

Routes::index();