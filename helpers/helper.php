<?php

function get_header(){
    require 'partials/header.php';
}
function get_footer(){
    require 'partials/footer.php';
}
function is_secret(){
    if(!isset($_SESSION['auth'])){
        header('location: login.php');
    }
}
function generate_token(){
    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
}