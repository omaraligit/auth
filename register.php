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
    if(!Validation::required($_POST['nom'])){
        $errors['nom'] = "Name not validated";
    }
    if(!Validation::required($_POST['prenom'])){
        $errors['prenom'] = "Last name not validated";
    }        
    if($_POST["password"]==""){
        $errors['password'] = "password required";
    }else if($_POST["password_c"]==""){
        $errors['password_c'] = "password confirmation required";
    }else if(!Validation::matching($_POST["password"],$_POST["password_c"])){
        $errors['password_c'] = "password validation not correct";
    }
    if (count($errors)==0) {
        $pdo = Database::getConnection();
        $user = new User($pdo);
        try {
            $user = $user->save(
                $_POST["login"],
                $_POST["nom"],
                $_POST["prenom"],
                $_POST["password"]);
                $_SESSION['auth'] = $user;
                header('location: index.php');
        } catch (\Exception $th) {
            $errors['login_user'] = "sorry but ".$_POST['login']." is already used";
        }
    
    }




}
?>


 <?php get_header(); ?>
<h3 class="text-center" > new User </h3>
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
                <?php if(isset($errors['login_user'])) : ?>
                <small id="emailHelp" class="form-text text-danger"><?=$errors['login_user']?></small>
                <?php endif; ?>

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="nom" placeholder="alex" value="<?= @$_POST['nom']?>">
                <?php if(isset($errors['nom'])) : ?>
                <small id="emailHelp" class="form-text text-danger"><?=$errors['nom']?></small>
                <?php endif; ?>

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Last name</label>
                <input type="text" class="form-control" name="prenom" placeholder="wasabi" value="<?= @$_POST['prenom']?>">
                <?php if(isset($errors['prenom'])) : ?>
                <small id="emailHelp" class="form-text text-danger"><?=$errors['prenom']?></small>
                <?php endif; ?>

            </div>


            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="*********">
                <?php if(isset($errors['password'])) : ?>
                <small class="form-text text-danger"><?=$errors['password']?></small>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <label for="exampleInputPassword1">Password confirmation</label>
                <input type="password" class="form-control" name="password_c" placeholder="*********">
                <?php if(isset($errors['password_c'])) : ?>
                <small class="form-text text-danger"><?=$errors['password_c']?></small>
                <?php endif; ?>
            </div>

            <input type="hidden" name="_token" value="<?=$_SESSION['_token']?>">

            <button type="submit" class="btn btn-primary">register</button><br>
            <a href="login.php">login now !</a>

        </form>
    </div>
  </div>

<?php get_footer(); ?>