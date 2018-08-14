<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 2/26/2018
     * Time: 1:14 PM
     */
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/top.php';
    include 'includes/navigation.php';
    include 'includes/slider.php';
    include 'includes/headerfull.php';
    include 'includes/leftbar.php';
    
    if (isset($_GET['cat'])){
        $cat_id = sanitize($_GET['cat']);
    }else{
        $cat_id = '';
    }
    
    $sql = "select * from products where categories='$cat_id'";
    $productQ = $db->query($sql);
    
    $category = get_category($cat_id);
?>
    <div class="col-md-8"><!--start col md 8-->
        <div class="row"><!--start row-->
    
            <h2 class="text-center"><?=$category['parent'].' '.$category['child'];?></h2>
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