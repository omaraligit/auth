<?php require 'bootstrap/init.php'; ?>
<?php is_secret(); ?>
<?php

session_destroy();
header('location: index.php');