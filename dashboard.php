<?php require 'bootstrap/init.php'; ?>
<?php is_secret(); ?>
<?php is_admin(); ?>
<?php 
    // get current page if not defined page = 1 
    $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
    $pdo   = Database::getConnection();
    $user  = new User($pdo);
    // if delete was posted
    if(isset($_POST['delete'])){
        // test token
        if($_SESSION['_token'] != $_POST['_token']){
            $errors['_token'] = "token miss match";
        }
        // delete user
        if (count($errors)==0) {
            $user->delete($_POST['delete_id']);
            header('location: dashboard.php?page='.$page);
        }
    }
    // get users count to make pages
    $count = $user->getPages();
    // get all users in db
    $users = $user->getAll($page);
?>
<?php get_header(); ?>


    <div class="container ">

        <h1>Hello , <?=$_SESSION['auth'][0]['nom']  ?>!</h1>

        <?php if(isset($errors['_token'])) : ?>
        <?php token_error($errors['_token']); ?>
        <?php endif; ?>

        <?php if(isset($_GET['delete']) && !isset($errors['_token'])) : ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Warrning!</h4>
            <p>You want to delete user ?</p>
            <hr>
            <form action="" method="post">
                <input type="" name="_token" value="<?=$_SESSION['_token']?>">
                <input type="hidden" name="delete_id" value="<?=$_GET['delete']?>">
                <input type="submit" value="supprimer" name="delete" class="btn btn-sm btn-danger">
            </form>
        </div>

        <?php endif ?>
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>Login</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Date inscription</th>
                    <th>Action</th>
                </tr>
                <tbody>
                <?php foreach ($users as $key => $user) : ?>
                    <tr>
                        <th><?=$user['login']?></th>
                        <th><?=$user['nom']?></th>
                        <th><?=$user['prenom']?></th>
                        <th><?=$user['created_at']?></th>
                        <th><a href="dashboard.php?page=<?=$page?>&delete=<?=$user['id']?>" class="btn btn-danger btn-sm" >Supprimer</a></th>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </thead>
        </table>

        <nav aria-label="text-center">
            <ul class="pagination pagination-sm">
                <li class="page-item"><a class="page-link" href="#"><</a></li>
                <?php for ($i=0; $i < $count/10; $i++) : ?>
                <li class="page-item<?= ((int)$page === $i+1)?' active':''?>">
                    <a class="page-link" href="dashboard.php?page=<?=$i+1?>"><?=$i+1?></a>
                </li>
                <?php endfor ?>
                <li class="page-item"><a class="page-link" href="#">></a></li>
            </ul>
        </nav>
        
    </div>


<?php get_footer(); ?>