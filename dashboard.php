<?php require 'bootstrap/init.php'; ?>
<?php is_secret(); ?>
<?php is_admin(); ?>
<?php get_header(); ?>


    <div class="container text-center">
        <h1>Hello , <?=$_SESSION['auth'][0]['nom']  ?>!</h1>
        <hr>
        <h2>User list</h2>
        <hr>
        
    </div>


<?php get_footer(); ?>