<?php
session_start();
/**
 * require helper functions
 */
require 'helpers/helper.php';


spl_autoload_register(function ($class){
    include 'classes/'.$class.'.php';
});

