<?php
require "config/global_config.php";

if (ENVIROMENT === ENV_DEV) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

////REVIEWER NOTE: 
//Would use autoload with namespaces to load the below classes.
require "model/movie_model.php";
require "model/category_model.php";
require "lib/view_paginator.php";


//REVIEWER NOTE: 
//Would call an appropriate controller class and its method here based on the route string if an .htaccess file was created for routing.
//To keep thigs simple if being tested on a machine without correct settings, just calling the only file.
require "movies.php";
