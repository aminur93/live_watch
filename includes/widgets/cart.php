<h3 class="text-center">Shopping Cart</h3>
<hr>
<div>
<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/24/2018
     * Time: 1:19 AM
     */
    if (empty($cart_id)):
    ?>
    <p style="margin-left: 20px;">Shopping cart is empty</p>
    <?php else:
        $cartQ = $db->query("select * from cart where id = '{$cart_id}'");
        $result = mysqli_fetch_assoc($cartQ);
        $items = json_decode($result['items'],true);
        $sub_total = 0;
        ?>
    <table class="table table-condensed" id="cart_widget">
        <tbody>
           <?php
              foreach ($items as $item):
                  $productQ = $db->query("select * from products where id = '{$item['id']}'");
              $product = mysqli_fetch_assoc($productQ);
           ?>
                  <tr>
                      <td><?=$item['quantity'];?></td>
                      <td><?=substr($product['title'],0,10);?></td>
                      <td><?=money($item['quantity'] * $product['price']);?></td>
                  </tr>
        
           <?php
              $sub_total += ($item['quantity'] * $product['price']);
              endforeach;?>
        <tr>
            <td></td>
            <td>Sub Totoal</td>
            <td><?=money($sub_total);?></td>
        </tr>
        </tbody>
    </table>
        <a href="cart.php" class="btn btn-xs btn-primary pull-right">View cart</a>
        <div class="clearfix"></div>
    <?php endif;?>
</div>