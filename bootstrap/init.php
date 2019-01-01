<?php
session_start();
/**
 * require helper functions
 */
require 'helpers/helper.php';

// errors bag


spl_autoload_register(function ($class){
    include_once 'classes/'.$class.'.php';
});

