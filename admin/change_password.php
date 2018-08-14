<link rel="stylesheet" href="../css/custom.css">
<?php
    ob_start();
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */
    
    require_once $_SERVER['DOCUMENT_ROOT'].'/final_project/core/init.php';
    if (!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    $hashed = $user_data['password'];
    $old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
    $old_password = trim($old_password);
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $password = trim($password);
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $confirm = trim($confirm);
    $new_hashed = password_hash($password, PASSWORD_DEFAULT);
    $user_id = $user_data['id'];
    $errors = array();
    
    //    $password = 'password';
    //    $hashed = password_hash($password, PASSWORD_DEFAULT);
    //    echo $hashed;

?>
<div id="login-form">
    <div>
        <?php
            if($_POST){
                //form validation
                if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) {
                    $errors[] = 'You must fill out all fields';
                }
                
                //password more then 6 character
                if(strlen($password) < 6){
                    $errors[] = 'Password must be at least 6 Characters';
                }
                
                if ($password != $confirm){
                    $errors[] = 'The password does not match. please try again';
                }
                
                if(!password_verify($old_password, $hashed)){
                    $errors[] = 'Your Old Password does not match our record!!!';
                }
                //check for errors
                if(!empty($errors)){
                    echo display_errors($errors);
                }  else {
                    //change password
                    $db->query("update users set password='$new_hashed' where id='$user_id'");
                    $_SESSION['success_flash'] = 'Your password has been updated';
                    header('Location: index.php');
                }
            }
        ?>
    </div>
    <h2 class="text-center">Change Password</h2>
    <form action="change_password.php" method="post">
        <div class="form-group">
            <label for="old_password">Old Password: </label>
            <input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
        </div>
        
        <div class="form-group">
            <label for="password">New Password: </label>
            <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
        </div>
    
        <div class="form-group">
            <label for="confirm">Confirm New Password: </label>
            <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
        </div>
        
        <div class="form-group">
            <a href="index.php" class="btn btn-default">Cancel</a>
            <input type="submit" value="Change Password" class="btn btn-success">
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ob_end_flush();?>