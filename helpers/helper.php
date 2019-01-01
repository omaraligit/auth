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
function is_admin(){
    if(!isset($_SESSION['auth'])){
        header('location: login.php');
    }else if($_SESSION['auth'][0]['login']!='admin'){
        header('location: login.php');
    }
}
function token_error($error){
    echo 
    '
    <div class="row">
        <div class="offset-sm-3 offset-md-4 col-md-4 col-sm-6 ">
        <div class="alert alert-danger">
        <b>'.$error.'</b>
        </div>
        </div>
    </div>
    ';
}
function generate_token(){
    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));
}