<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/27/2018
     * Time: 12:17 AM
     */
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/top.php';
    include 'includes/navigation.php';
    include 'includes/slider.php';
    include 'includes/headerfull.php';
    include 'includes/leftbar.php';
    
    $sql = "select * from products";
    $cat_id = (($_POST['cat'] != '')?sanitize($_POST['cat']):'');
    if ($cat_id == ''){
        $sql .= ' where deleted = 0';
    }else{
        $sql .= " where categories = '{$cat_id}' and deleted = 0";
    }
    $user_query = (($_POST['user_query'])?sanitize($_POST['user_query']):'');
    if ($user_query != ''){
        $sql .= " and product_keyword LIKE '%$user_query%'";
    }
    $productQ = $db->query($sql);
    $category = get_category($cat_id);
?>
    <div class="col-md-8"><!--start col md 8-->
        <div class="row"><!--start row-->
            <?php if ($cat_id != ''):?>
                <h2 class="text-center"><?=$category['parent'].' '.$category['child'];?></h2>
            <?php else:?>
                <h2 class="text-center">Live Trial Watch Store</h2>
            <?php endif;?>
            <?php while ($product = mysqli_fetch_assoc($productQ)):?>
                <div class="col-md-3" style="margin-bottom: 20px;">
                    <h4 class="text-center"><?= $product['title'];?></h4>
                    <?php $photos = explode(',',$product['image'])?>
                    <img src="<?= $photos[0];?>" height="300px" width="200px">
                    <p class="list-price text-danger text-center" style="margin-top: 5px;">List Price: <s>$<?= $product['list_price'];?></s></p>
                    <p class="price text-center">Our Price: $<?= $product['price'];?></p>
                    <button class="btn btn-sm btn-success" style="margin-left: 35px;" type="button" onclick="detailsmodal(<?= $product['id'];?>)">Details</button>
                    <button class="btn btn-sm btn-primary" type="button" onclick="trailmodal(<?= $product['id'];?>)">Trail Now</button>
                </div>
            <?php endwhile;?>
        </div><!--end row-->
    </div><!--end col md 8-->

<?php
    include 'includes/rightbar.php';
    include 'includes/footer.php';
?>