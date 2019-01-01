<?php include_once 'bootstrap/init.php'; ?>

<?php
    if(isset($_SESSION['auth'])){
        header('location: index.php');
    }
/**
 * login attempte!
 */
$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    if($_SESSION['_token'] != $_POST['_token']){
        $errors['_token'] = "token miss match";
    }
    // validate fields
    if(!Validation::required($_POST['login'])){
        $errors['login'] = "login not validated";
    }
    if($_POST["password"]==""){
        $errors['password'] = "password required";
    }
    if (count($errors)==0) {
        $pdo = Database::getConnection();
        $user = new User($pdo);
        $user = $user->login($_POST['login'],$_POST["password"]);
        // test user in database
        if(count($user)>0){
            $_SESSION['auth'] = $user;
            if($user[0]['login']!='admin')
                header('location: index.php');
            else
                header('location: dashboard.php');
        }else{
            $errors['login'] = "login or password not validated";
        }
       

    }




}
?>


 <?php get_header(); ?>

        <?php if(isset($errors['_token'])) : ?>
        <?php token_error($errors['_token']); ?>
        <?php endif; ?>

  <div class="row">
    <div class="offset-sm-3 offset-md-4 col-md-4 col-sm-6 ">

        <form action="" method="post" class="">

            <div class="form-group">
                <label for="exampleInputEmail1">Login</label>
                <input type="text" class="form-control" name="login" placeholder="Enter login" value="<?= @$_POST['login']?>">
                <?php if(isset($errors['login'])) : ?>
                <small id="emailHelp" class="form-text text-danger"><?=$errors['login']?></small>
                <?php endif; ?>

            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                <?php if(isset($errors['password'])) : ?>
                <small class="form-text text-danger"><?=$errors['password']?></small>
                <?php endif; ?>
            </div>

            <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">

            <button type="submit" class="btn btn-primary">Login</button><br>
            <a href="register.php">create a new acount</a>
        </form>
    </div>
  </div>

<?php get_footer(); ?>