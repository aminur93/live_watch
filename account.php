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
                        $txnQ = "select t.id, t.cart_id, t.users_id, t.full_name, t.description, t.txn_date, t.grand_total, c.items, c.hand_size, c.paid, c.shipped, s.email, s.id
                                from transactions t
                                LEFT JOIN cart c ON t.cart_id = c.id
                                LEFT JOIN customer_user s ON t.users_id = s.id
                                where c.paid = 1 AND c.shipped = 0 AND s.id = '$users_id'
                                ORDER BY t.txn_date";
                        $txnresult = $db->query($txnQ);
                ?>
                
                <h4>My Recent Purchases</h4>
                
                <table class="table table-striped tcart">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Users Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Totoal</th>
                        <th>Hand Ribs Size</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($order = mysqli_fetch_assoc($txnresult)):?>
                        <tr>
                            <td><a href="invoice.php?txn_id=<?=$order['id'];?>" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-info-sign"></span></a></td>
                            <td><?=$order['users_id'];?></td>
                            <td><?=$order['full_name']?></td>
                            <td><?=$order['description']?></td>
                            <td><?=money($order['grand_total']);?></td>
                            <td><?=$order['hand_size'];?></td>
                            <td><?= pretty_date($order['txn_date']);?></td>
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
