<?php require 'bootstrap/init.php'; ?>

<?php
/**
 * login attempte!
 */
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // validate fields
    
    // test token match
    if($_SESSION['_token'] == $_POST['_token']){
       
    }else{
        
    }
    // test user in database

    // redirect to home if user or dashboard if admin

}
?>


<?php get_header(); ?>



  <div class="row">
    <div class="col-md-4 offset-md-4">
        <form action="" method="post" class="">

            <div class="form-group">
                <label for="exampleInputEmail1">Login</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter login">
                <small id="emailHelp" class="form-text text-danger">User with this login is not found or passsword incorrect.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <input type="text" name="_token" value="<?=$_SESSION['_token']?>">

            <button type="submit" class="btn btn-primary">Login</button>

        </form>
    </div>
  </div>

<?php get_footer(); ?>