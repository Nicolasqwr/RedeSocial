<?php

    session_start();
    date_default_timezone_set('America/Sao_paulo');

    define('INCLUDE_PATH_STATIC', 'http://localhost/DESENVOLVIMENTO%20WEB/DankiCode/Views/pages/');   
    define('INCLUDE_PATH', 'http://localhost/DESENVOLVIMENTO%20WEB/');
    require('vendor/autoload.php');
    $app = new DankiCode\Application();

    $app->run()

?>