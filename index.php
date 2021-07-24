<?php
require "config/global_config.php";
if (ENVIROMENT === ENV_DEV) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require "model/MoviesModel.php";
require "movies.php";
