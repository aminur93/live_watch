<?php
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/top.php';
    include 'includes/navigation.php';
    include 'includes/slider.php';
    include 'includes/headerfull.php';
    include 'includes/leftbar.php';
    
    $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
    $email = trim($email);
    
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $password = trim($password);
    
    $errors = array();
    
?>
    
    <div class="col-md-8"><!--start col md 8-->
        <div class="row"><!--start row-->
            <?php
            if ($_POST){
                //form validation
                if (empty($_POST['email']) || empty($_POST['password'])){
                    $errors[] = 'You Must Provide Email And Password';
                }
                
                //validate email
                if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $errors[] = 'You Must Provide Valid Email Address';
                }
                
                //Validate Password
                if (strlen($password) < 6){
                    $errors[] = 'Password Must be At Least 6 Character';
                }
                
                //Check If customer database Exist
                 $query = $db->query("select * from customer_user where email = '$email'");
                 $customer = mysqli_fetch_assoc($query);
                 $customerCount = mysqli_num_rows($query);
                 if ($customerCount<1){
                     $errors[] = 'The Email Dosent Exist in Our Database';
                 }
                 if (!password_verify($password, $customer['password'])){
                     $errors[] = 'The Password Did not Match Our Record. Please try Again...';
                 }
                 
                 //Check For Error
                if (!empty($errors)){
                     echo display_errors($errors);
                }else{
                     //log customer in
                    $users_id = $customer['id'];
                    customerLogin($users_id);
                }
            }
            ?>
            <form action="login.php" method="post">
                <h3 class="text-center">Login Now</h3>
                <hr>
                
                <div class="col-md-12">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Enter Email" class="form-control">
                </div>
                </div>
    
                <div class="col-md-12">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control">
                </div>
                </div>
    
                <input type="submit" class="btn btn-primary" name="login" value="Login" style="margin-bottom: 10px;margin-left: 20px;">
                <a href="register.php" class="btn btn-warning" style="margin-top: -10px;">Regiter Now</a>
            </form>
        </div><!--end row-->
    </div><!--end col md 8-->

<?php
    include 'includes/rightbar.php';
    include 'includes/footer.php';
?>