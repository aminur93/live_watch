<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/24/2018
     * Time: 7:20 PM
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
    $price_sort = (($_POST['price_sort'] != '')?sanitize($_POST['price_sort']):'');
    $min_price = (($_POST['min_price'] != '')?sanitize($_POST['min_price']):'');
    $max_price = (($_POST['max_price'] != '')?sanitize($_POST['max_price']):'');
    $brand = (($_POST['brand'] != '')?sanitize($_POST['brand']):'');
    if ($min_price != ''){
        $sql .= " and price >= '{$min_price}'";
    }
    if ($max_price != ''){
        $sql .= " and price <= '{$max_price}'";
    }
    if ($brand != ''){
        $sql .= " and brand = '{$brand}'";
    }
    if ($price_sort == 'low'){
        $sql .= " ORDER BY price";
    }
    if ($price_sort == 'high'){
        $sql .= " ORDER BY price DESC";
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
                    <?php $photos = explode(',',$product['image']);?>
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