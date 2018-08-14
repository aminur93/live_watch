<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/24/2018
     * Time: 6:15 PM
     */
    $cat_id = ((isset($_REQUEST['cat']))?sanitize($_REQUEST['cat']):'');
    $price_sort = ((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['price_sort']):'');
    $min_price = ((isset($_REQUEST['min_price']))?sanitize($_REQUEST['min_price']):'');
    $max_price = ((isset($_REQUEST['max_price']))?sanitize($_REQUEST['max_price']):'');
    $b = ((isset($_REQUEST['brand']))?sanitize($_REQUEST['brand']):'');
    $brandQ = $db->query("select * from brand ORDER BY brand");
    
    ?>
<h3 class="text-center">Search By:</h3>
<hr>
<h4 class="text-center">Price</h4><hr>
<form action="search.php" method="post">
    <input type="hidden" name="cat" value="<?=$cat_id;?>">
    <input type="hidden" name="price_sort" value="0">
    <input type="radio" style="margin-left: 40px;" name="price_sort" value="low"<?=(($price_sort == 'low')?' checked':'');?>> Low To High <br>
    <input type="radio" style="margin-left: 40px;" name="price_sort" value="high"<?=(($price_sort == 'high')?' checked':'');?>> High To Low <br><br>
    <input type="text" name="min_price" class="price-range form-control" placeholder="Min $" value="<?=$min_price;?>"><center>To</center>
    <input type="text" name="max_price" class="price-range form-control" placeholder="Max $" value="<?=$max_price;?>"><br><br>
    <h4 class="text-center">Brand</h4><hr>
    <input type="radio" style="margin-left: 40px;" name="brand" value=""<?=(($b == '')?' checked':'');?>> All <br>
    <?php while ($brand = mysqli_fetch_assoc($brandQ)):?>
        <input type="radio" style="margin-left: 40px;" name="brand" value="<?=$brand['id'];?>"<?=(($b == $brand['id'])?' checked':'');?>> <?=$brand['brand'];?>
        <br>
    <?php endwhile;?>
    <br>
    <input type="submit" style="margin-left: 40px;margin-bottom: 20px;" value="Search" class="btn btn-xs btn-primary">
</form>
