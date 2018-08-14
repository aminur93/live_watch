<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 5/5/2018
     * Time: 3:04 AM
     */
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/top.php';
    include 'includes/navigation.php';
    
    $hashed = $customer_data['password'];
    $old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
    $old_password = trim($old_password);
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $password = trim($password);
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $confirm = trim($confirm);
    $new_hashed = password_hash($password, PASSWORD_DEFAULT);
    $user_id = $customer_data['id'];
    $errors = array();
    
    if (isset($_SESSION['CBuser'])) {
        $users_id = $_SESSION['CBuser'];
        $query = $db->query("select * from customer_user where id = '{$users_id}'");
        $customer_data = mysqli_fetch_assoc($query);
    }
?>
<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2 style="color: #009fe8;"><i class="fa fa-desktop color"></i> My Account <small><?=$customer_data['fname'];?> <?=$customer_data['lname'];?></small></h2>
        <hr />
    </div>
</div>
<!-- Page title -->

<!-- Page content -->

<div class="account-content">
    <div class="container">
        
        <div class="row">
            <div class="col-md-3">
                <div class="sidey">
                    <ul class="nav">
                        <li><a href="account.php">My Account</a></li>
                        <li><a href="account_edit.php">Edit Profile</a></li>
                        <li><a href="account_changePassword.php">Change Password</a></li>
                        <li><a href="timage.php">Trial Image</a></li>
                        <li><a href="customer_orders.php">Order History</a></li>
                        <li><a href="account_delete.php?delete=<?=$users_id;?>">Delete Acount</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <h3><i class="fa fa-user color"></i> &nbsp;My Account</h3>
                <!-- Your details -->
                <div class="address">
                    <address>
                        <!-- Your name -->
                        <strong><?=$customer_data['fname'];?> <?=$customer_data['lname'];?></strong><br>
                        <!-- Address -->
                        <?=$customer_data['address'];?><br>
                        <!-- Phone number -->
                        <abbr title="Phone">P:</abbr> (+880)<?=$customer_data['phone_number'];?> .<br />
                        <a href="mailto:#"><?=$customer_data['email'];?></a>
                    </address>
                </div>
                
                <hr />
                
                <h4>Change Password</h4>
                <hr>
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
                            $db->query("update customer_user set password='$new_hashed' where id='$users_id'");
                            $_SESSION['success_flash'] = 'Your password has been updated';
                            header('Location: index.php');
                        }
                    }
                ?>
                <form action="account_changePassword.php" method="post">
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" name="old_password" id="old_password" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <label for="confirm">Confirm Password</label>
                        <input type="password" name="confirm" id="confirm" class="form-control">
                    </div>
    
                    <div class="form-group">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                        <input type="submit" value="Change Password" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    
        <div class="sep-bor"></div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>