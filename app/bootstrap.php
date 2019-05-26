<?php
    //load config
    require_once 'config/config.php';

    //load libraries
//require_once 'libraries/core.php';
//require_once 'libraries/controller.php';
//require_once 'libraries/database.php';

    //auto-load core libraries
    spl_autoload_register(function($className) {
        require_once 'libraries/' . $className . '.php';
    });
