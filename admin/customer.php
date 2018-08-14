<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 5/1/2018
     * Time: 2:26 AM
     */
    require_once '../core/init.php';
    if (!is_logged_in()){
        header('Location: login.php');
    }
    if (!has_permission('admin')){
        permission_error_redirect('index.php');
    }
    
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/top.php';
    
    //Delete Customer
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $sql = "delete from customer_user where id = '$delete_id'";
        $db->query($sql);
        header('Location: customer.php');
    }
    
    //Show Customer database
    $sql = "select * from customer_user";
    $result = $db->query($sql);
    ?>
<h2 class="text-center">Customer Details</h2>
<hr>
<table class="table table-condensed table-striped table-bordered">
    <thead>
    <th></th>
    <th>Sr #</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Image</th>
    <th>Phone Number</th>
    <th>Address</th>
    </thead>
    <tbody>
    <?php while ($user = mysqli_fetch_assoc($result)):?>
    <tr>
        <td>
        <a href="customer.php?delete=<?=$user['id']?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
        </td>
        <td><?=$user['id'];?></td>
        <td><?=$user['fname'];?></td>
        <td><?=$user['lname'];?></td>
        <td><?=$user['email'];?></td>
        <td><img src="../images/user/<?=$user['image'];?>" alt="" width="30px;"></td>
        <td><?=$user['phone_number'];?></td>
        <td><?=substr($user['address'],0,15);?></td>
    </tr>
    <?php endwhile;?>
    </tbody>
</table>
<?php include 'includes/footer.php';?>
