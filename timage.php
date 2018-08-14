<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/30/2018
     * Time: 7:45 PM
     */
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/top.php';
    include 'includes/navigation.php';
    
    if (isset($_SESSION['CBuser'])) {
        $users_id = $_SESSION['CBuser'];
        $query = $db->query("select * from customer_user where id = '{$users_id}'");
        $customer_data = mysqli_fetch_assoc($query);
    }
    
    if (isset($_GET['delimage']) && !empty($_GET['delimage'])){
        $delete = (int)$_GET['delimage'];
        
        $getimage = "select * from trial where users_id = '$users_id'";
        $result = $db->query($getimage);
        while ($delImagedata = mysqli_fetch_assoc($result)){
            $delete = $delImagedata['image'];
            unlink($delete);
        }
        
        $sql = "delete from trial where users_id = '$users_id'";
        $db->query($sql);
        header("Location:account.php");
    }
?>
<!-- Page title -->
<div class="page-title">
    <div class="container">
        <h2 style="color: #009fe8;"><img src="images/user/<?=$customer_data['image'];?>" width="100px;" class="img-thumbnail img-circle"> <small><?=ucfirst($customer_data['fname']);?> <?=$customer_data['lname'];?></small></h2>
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
                        <li><a href="account_edit.php?edit=<?=$users_id;?>">Edit Profile</a></li>
                        <li><a href="account_changePassword.php">Change Password</a></li>
                        <li><a href="timage.php">Trial Image</a></li>
                        <li><a href="customer_orders.php">Order History</a></li>
                        <li><a href="account_delete.php?delete=<?=$users_id;?>">Delete Acount</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
            <br><br>
            
            <div class="col-md-9">
                <h3><i class="fa fa-info"></i> &nbsp;User Information</h3>
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
                    if (isset($_SESSION['CBuser']) == $users_id) {
                        $users_id = $_SESSION['CBuser'];
                        $txnQ = "select * from trial where users_id = '$users_id'";
                        $txnresult = $db->query($txnQ);
                        ?>
                        
                        <h4>User Trial Image</h4>
                        
                        <table class="table table-striped tcart">
                            <thead>
                            <tr>

                                <th>Users Id</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($order = mysqli_fetch_assoc($txnresult)):?>
                                <tr>
                                <td><?= $order['users_id'];?></td>
                               <td><img src="<?=$order['image'];?>"  width="50" height="50"></td>
                                <td><a href="timage.php?delimage=<?= $order['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>
                        </table>
                    <?php } ?>
            </div>
        </div>
        
        <div class="sep-bor"></div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
