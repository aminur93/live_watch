<?php
    ob_start();
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 2/23/2018
     * Time: 3:44 PM
     */
    require_once $_SERVER['DOCUMENT_ROOT'].'/final_project/core/init.php';
    if (!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/top.php';
    
    //delete product form arctive
    if (isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete_id'];
        $delete_id = sanitize($delete_id);
        $db->query("delete from products where id='$delete_id'");
        header('Location: archive.php');
    }
    
    $sql = "select * from products where deleted=1";
    $result = $db->query($sql);
    
    //archive product process
    if(isset($_GET['archive'])){
        $id = sanitize($_GET['archive']);
        $reset = "update products set deleted=0 AND featured=1 where id='$id'";
        $result = $db->query($reset);
        header('Location: archive.php');
    }
    ?>
    <h2 class="text-center">Archive Product</h2>
    <table class="table table-bordered table-responsive table-striped">
      <thead>
      <th></th>
      <th></th>
      <th>Title</th>
      <th>Pirce</th>
      <th>Category</th>
      <th>Sold</th>
      </thead>
        <tbody>
        <?php while ($product = mysqli_fetch_assoc($result)):
            $childId = $product['categories'];
            $catsql = "select * from categories where id ='$childId'";
            $cresult = $db->query($catsql);
            $child = mysqli_fetch_assoc($cresult);
            $parentId = $child['parent'];
            $psql = "select * from categories where id ='$parentId'";
            $presult = $db->query($psql);
            $parent = mysqli_fetch_assoc($presult);
            $category = $parent['category'].'-'.$child['category'];
            ?>
            <tr>
                <td><a href="archive.php?archive=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a></td>
                <td><a href="archive.php?delete=<?=$product['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
                <td><?=$product['title'];?></td>
                <td><?=  money($product['price']);?></td>
                <td><?=$category;?></td>
                <td>0</td>
            </tr>
        <?php endwhile;?>
        </tbody>
    </table>
<?php include 'includes/footer.php'; ob_end_flush();?>
