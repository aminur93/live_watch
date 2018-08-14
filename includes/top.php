<?php
    if (isset($_SESSION['CBuser'])){
        $customer_id = $_SESSION['CBuser'];
        $query = $db->query("select * from customer_user where id = '$customer_id'");
        $customer_data = mysqli_fetch_assoc($query);
    }
?>
<div id="top"><!--start top bar-->
    <div class="container">
        <div class="col-md-6 offer">
            <a href="account.php" class="btn btn-info btn-sm">
                <?php if (isset($_SESSION['CBuser'])):?>
                    Welcome : <?=$customer_data['fname'];?>
                <?php endif;?>
                <?php if (!isset($_SESSION['CBuser'])):?>
                  Welcome : Guest
                <?php endif;?>
            </a>
        </div><!--col-md-6 offer end-->

        <div class="col-md-6">
            <ul class="menu">
                    <li><a href="register.php"><span class="glyphicon glyphicon-registration-mark"></span> Register</a></li>
                    <li><a href="account.php"><span class="glyphicon glyphicon-bell"></span> My Account</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul><!--menu ends-->
        </div><!--col-md-6 ends-->
    </div><!--end conatiner-->
</div><!--end top-->
