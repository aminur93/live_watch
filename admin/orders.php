<?php
    ob_start();
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/27/2018
     * Time: 2:13 AM
     */
    require_once '../core/init.php';
    if (!is_logged_in()){
        header('Location: login.php');
    }
    
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/top.php';
    
    //complete order
    if(isset($_GET['complete']) && $_GET['complete'] == 1){
        
        $cart_id = sanitize((int)$_GET['cart_id']);
        $db->query("update cart set shipped=1 where id='{$cart_id}'");
        $_SESSION['success_flash'] = 'The Order has Been Completed';
        header('Location: index.php');
    }
    
    $txn_id = sanitize((int)$_GET['txn_id']);
    $txnQuery = $db->query("select * from transactions where id = '{$txn_id}'");
    $txn = mysqli_fetch_assoc($txnQuery);
    $cart_id = $txn['cart_id'];
    $cartQ = $db->query("select * from cart where id = '{$cart_id}'");
    $cart = mysqli_fetch_assoc($cartQ);
    $items = json_decode($cart['items'],true);
    $idArray = array();
    $products = array();
    foreach ($items as $item){
        $idArray[] = $item['id'];
    }
    $ids = implode(',',$idArray);
    $productQ = $db->query("select i.id as 'id', i.title as 'title', c.id as 'cid', c.category as 'child', p.category 'parent'
    from products i
    LEFT JOIN categories c ON i.categories = c.id
    LEFT JOIN categories p ON c.parent = p.id
    where i.id IN ({$ids})");
    
    while ($p = mysqli_fetch_assoc($productQ)){
        foreach ($items as $item){
            if ($item['id'] == $p['id']){
                $x = $item;
                continue;
            }
        }
        $products[] = array_merge($x,$p);
    }
    ?>
    <h3 class="text-center">Items Order</h3>
        <table class="table table-bordered table-condensed table-striped table-responsive">
            <thead>
            <th>Quantity</th>
            <th>Title</th>
            <th>Category</th>
            <th>Size</th>
            </thead>
            <tbody>
            <?php foreach ($products as $product):?>
                <tr>
                    <td><?=$product['quantity'];?></td>
                    <td><?=$product['title'];?></td>
                    <td><?=$product['parent'].'~'.$product['child'];?></td>
                    <td><?=$product['size'];?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
    </table>

<div class="row">
    <div class="col-md-6">
        <h3 class="text-center">Order Details</h3>
        <table class="table table-bordered table-condensed table-striped table-responsive">
            <tr>
                <td>Sub Total</td>
                <td><?=  money($txn['sub_total']);?></td>
            </tr>
    
            <tr>
                <td>Hand Ribs Size</td>
                <td><?=  $cart['hand_size'];?></td>
            </tr>
            
            <tr>
                <td>Tax</td>
                <td><?=  money($txn['tax']);?></td>
            </tr>
            
            <tr>
                <td>Grand Total</td>
                <td><?=  money($txn['grand_total']);?></td>
            </tr>
            
            <tr>
                <td>Order Date</td>
                <td><?=  pretty_date($txn['txn_date']);?></td>
            </tr>
        
        </table>
    </div>
    <div class="col-md-6">
        <h3 class="text-center">Shipping Address</h3>
        <address class="text-center">
            <?=$txn['full_name'];?><br>
            <?=$txn['street'];?><br>
            <?=($txn['street2'] != '')?$txn['street2'].'<br>':'';?>
            <?=$txn['city'].' '.$txn['state'].' '.$txn['zip_code'].'<br>';?>
            <?=$txn['country'];?>
        </address>
    </div>
</div>

<div class="pull-right">
    <a href="orders.php?complete=1&cart_id=<?=$cart_id;?>" id="print" class="btn btn-primary">Complete Order</a>
    <a class="btn btn-success" id="printpagebutton" onclick="myFunction()"><span class="glyphicon glyphicon-print"></span> Print </a>
</div><br><br><br><br><br><br><br><br><br><br>
<?php include 'includes/footer.php';?>

<script>
    function myFunction() {
        var printButton = document.getElementById("printpagebutton");
        var another = document.getElementById("print");
        another.style.visibility = 'hidden';
        printButton.style.visibility = 'hidden';
        window.print();
        printButton.style.visibility = 'visible';
        another.style.visibility = 'visible';
       
    }
</script>

