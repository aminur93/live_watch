<?php 
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/top.php';
include 'includes/navigation.php';
include 'includes/slider.php';
include 'includes/headerfull.php';
include 'includes/leftbar.php';

$sql = "select * from products where featured=1 LIMIT 0,4";
$featured = $db->query($sql);
    
    $perpage = 12;
    
    if(isset($_GET['page']) & !empty($_GET['page'])){
        $curpage = $_GET['page'];
    }else{
        $curpage = 1;
    }
    
    
    $start = ($curpage * $perpage) - $perpage;
    
    $PageSql = "SELECT * FROM products where featured='1'";
    $pageres = $db->query($PageSql);
    $totalres = mysqli_num_rows($pageres);
    
    $endpage = ceil($totalres/$perpage);
    $startpage = 1;
    $nextpage = $curpage + 1;
    $previouspage = $curpage - 1;
    
    $ReadSql = "SELECT * FROM products where featured='1' LIMIT $start, $perpage";
    $featured = $db->query($ReadSql);
?>   

<div class="col-md-8"><!--start col md 8-->
    <div class="row"><!--start row-->

    <h2 class="text-center">Featured product</h2>
     <?php while ($product = mysqli_fetch_assoc($featured)):?>
    
        <div class="col-md-3 single" style="margin-bottom: 20px;">
            <h4 class="text-center"><?= $product['title'];?></h4>
            <?php $photos = explode(',',$product['image']); ?>
            <img src="<?= $photos[0];?>" height="300px" width="200px">
            <p class="list-price text-danger text-center" style="margin-top: 5px;">List Price: <s>$<?= $product['list_price'];?></s></p>
            <p class="price text-center">Our Price: $<?= $product['price'];?></p>
            <button class="btn btn-sm btn-success btn-sally" style="margin-left: 35px;" type="button" onclick="detailsmodal(<?= $product['id'];?>)">Details</button>
            <button class="btn btn-sm btn-primary btn-sally" type="button" onclick="trailmodal(<?= $product['id'];?>)">Trial Now</button>
        </div>
    <?php endwhile;?>
    </div><!--end row-->
    
    <nav aria-label="Page navigation example" class="text-center">
        <ul class="pagination pagination-lg">
            <?php if($curpage != $startpage){ ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $startpage;?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php } ?>
    
            <?php if($curpage >= 2){ ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
            <?php } ?>
            <li class="page-item active"><a class="page-link" href="index.php?page=<?php echo $curpage;?>"><?php echo $curpage ?></a></li>
            <?php if($curpage != $endpage){ ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
            <?php } ?>
            
            <?php if($curpage != $endpage){ ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $endpage;?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </nav>
    
</div><!--end col md 8-->

<?php
include 'includes/rightbar.php';
include 'includes/footer.php';
?>
        
        
   