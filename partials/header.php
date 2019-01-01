<?php generate_token(); ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>User managment</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php if(isset($_SESSION['auth'])):  ?>
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php endif; ?>
      <?php if(isset($_SESSION['auth']) && $_SESSION['auth'][0]['login'] == 'admin'):  ?>
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">Admin Panel <span class="sr-only">(current)</span></a>
      </li>
      <?php endif; ?>
      <?php if(isset($_SESSION['auth'])):  ?>
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Deconnection <span class="sr-only">(current)</span></a>
      </li>
      <?php endif; ?>


    </ul>
  </div>
</nav>