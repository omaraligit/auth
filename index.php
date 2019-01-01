<?php require 'bootstrap/init.php'; ?>
<?php is_secret(); ?>
<?php get_header(); ?>


    <div class="container text-center">
        <h1>Hello, <?=$_SESSION['auth'][0]['nom']  ?>!</h1>
    </div>


<?php get_footer(); ?>