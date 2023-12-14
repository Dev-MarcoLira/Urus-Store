<?php

    /* autoloading classes */

	include('autoloader.php');

    spl_autoload_register($autoload);
    
    define('FULL_PATH_SITE', 'http://localhost/UrusStore/');
    define('FULL_PATH_PANEL', 'http://localhost/UrusStore/panel/');
    define('FULL_PATH_ESTOQUE', FULL_PATH_PANEL.'estoque/');
    define('FULL_PATH', '');

    define('PATH_CONTROLLERS', FULL_PATH.'controllers/');
    define('PATH_MODELS', FULL_PATH.'models/');
    define('PATH_UPLOAD', 'uploads/');
    define('FULL_PATH_UPLOAD', FULL_PATH_PANEL.'uploads/');

    define('PATH_VIEWS', FULL_PATH.'views/');
    define('PATH_ESTOQUE', PATH_VIEWS.'src/estoque/');
    define('PATH_IMAGES', FULL_PATH_PANEL.PATH_VIEWS.'images/');
    define('PATH_ICONS', PATH_IMAGES.'icons/');
    define('PATH_SCRIPTS', FULL_PATH_PANEL.PATH_VIEWS.'scripts/');
    define('PATH_CSS', FULL_PATH_PANEL.PATH_VIEWS.'css/');

    define('PATH_VIEWS_GLOBAL', '../views/');
    define('PATH_CSS_SITE', FULL_PATH_SITE.'views/css/');
    define('PATH_ICONS_SITE', FULL_PATH_SITE.'views/images/icons/');
    define('PATH_SCRIPTS_SITE', FULL_PATH_SITE.'views/scripts/');

    include('../config/dbconfig.php');
?>