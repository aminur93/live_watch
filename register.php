<?php
    ob_start();
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/10/2018
     * Time: 11:02 PM
     */

    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/top.php';
    include 'includes/navigation.php';
    include 'includes/slider.php';
    include 'includes/headerfull.php';
    include 'includes/leftbar.php';
    
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
                $insertSql = "insert into customer_user(fname,lname,email,password,image,phone_number,address) VALUES ('$fname','$lname','$email','$hashed','$image','$phone_number','$address')";
                $db->query($insertSql);
                $_SESSION['success_flash'] = 'Customer Register Is Complete';
                header('Location: login.php');
            }
        }
    }
    
?>
    
    <div class="col-md-8"><!--start col md 8-->
        <div class="row"><!--start row-->
            
            <form action="register.php" method="post" enctype="multipart/form-data">
                <h3 class="text-center">Register Now</h3>
                <hr>
                <div class="col-sm-6">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname" placeholder="Enter first name" class="form-control">
                </div>
                </div>
    
                <div class="col-sm-6">
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname" placeholder="Enter last name" class="form-control">
                </div>
                </div>
    
                <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control">
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
                    <input type="text" name="phone_number" id="phone_number" placeholder="Enter phone number" class="form-control">
                </div>
                </div>
    
                <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Address:</label>
                    <textarea name="address" id="address" cols="30" rows="10" style="resize: none;" class="form-control"></textarea>
                </div>
                </div>
                
                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Register" style="margin-bottom: 10px;margin-right: 20px;">
            </form>
        </div><!--end row-->
    </div><!--end col md 8-->

<?php
    include 'includes/rightbar.php';
    include 'includes/footer.php';
?>