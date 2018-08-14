<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 5/6/2018
     * Time: 12:23 AM
     */
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/top.php';
    include 'includes/navigation.php';
    
    if (isset($_GET['edit'])){
        $users_id = $_GET['edit'];
        $edit = $db->query("select * from customer_user where id = '$users_id'");
        $edit_result = mysqli_fetch_assoc($edit);
        
        $fname = $edit_result['fname'];
        $lname = $edit_result['lname'];
        $email = $edit_result['email'];
        $image = $edit_result['image'];
        $phone_number = $edit_result['phone_number'];
        $address = $edit_result['address'];
    }
   
    
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
        <?php
        if (isset($_POST['submit'])){
            $fname = sanitize($_POST['fname']);
            $lname = sanitize($_POST['lname']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
            $phone_number = sanitize($_POST['phone_number']);
            $address = sanitize($_POST['address']);
            $image = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $errors = array();
    
            $path = "images/user/$image";
            move_uploaded_file($tmp_name, $path);
    
            //Validation
            if ($_POST){
                $emailQ = $db->query("select * from customer_user where email = '$email'");
                $emailCount = mysqli_num_rows($emailQ);
        
                //Email exist in database
                if ($emailCount != 0){
                    $errors[] = 'Email Exist In database';
                }
                $required = array('fname','lname','email','password','phone_number','address');
                foreach ($required as $f){
                    if (empty($_POST[$f])){
                        $errors[] = 'You Must Fill Out All Fields';
                        break;
                    }
                }
        
                //Password length
                if (strlen($password) < 6){
                    $errors[] = 'Your Password Must Be 6 character';
                }
                //email validation
                if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $errors[] = 'You Must Enter Valid Email';
                }
                //Display Error
                if (!empty($errors)){
                    echo display_errors($errors);
                }else{
                    //Add user informstion into database
                    $hashed = password_hash($password,PASSWORD_DEFAULT);
                    $insertSql = "update customer_user set
                     fname = '$fname', lname = '$lname',
                     email = '$email', password = '$hashed', image = '$image', phone_number = '$phone_number', address = '$address' where id = '$users_id'";
                    $db->query($insertSql);
                    $_SESSION['success_flash'] = 'Customer Profile Update Is Complete';
                    header('Location: account.php');
                }
            }
            
        }
        ?>
        
        <form action="account_edit.php" method="post" enctype="multipart/form-data">
            <h3 class="text-center">Update Your Information</h3>
            <hr>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname" placeholder="Enter first name" class="form-control" value="<?=$fname;?>">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname" placeholder="Enter last name" class="form-control" value="<?=$lname;?>">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control" value="<?=$email;?>">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image"  class="form-control">
                </div>
            </div>


            <div class="col-sm-6">
                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" id="phone_number" placeholder="Enter phone number" class="form-control" value="<?=$phone_number;?>">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Address:</label>
                    <textarea name="address" id="address" cols="30" rows="10" style="resize: none;" class="form-control"><?=$address;?></textarea>
                </div>
            </div>
    
            <div class="col-sm-6">
                <div class="form-group">
                   <?php
                   echo "<img src='images/user/$image' width='250px' height='250px'>";
                   ?>
                </div>
            </div>

            <input type="submit" name="submit" class="btn btn-primary" value="Register" style="margin-bottom: 10px;margin-left: 20px;">
        </form>
    </div>
</div>
            
            <div class="sep-bor"></div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>