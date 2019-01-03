<?php require 'bootstrap/init.php'; ?>
<?php is_secret(); ?>
<?php is_admin(); ?>
<?php 
    // get current page if not defined page = 1 
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $pdo   = Database::getConnection();
    $user  = new User($pdo);
    $user->fillDB();
?>