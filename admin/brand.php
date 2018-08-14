<?php 
ob_start();
require_once '../core/init.php';
    if (!is_logged_in()){
        login_error_redirect();
    }
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/top.php';

//get brand from database
$sql = "select * from brand order by brand ASC";
$result = $db->query($sql);
$errors = array();

//Edit Brand
if (isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $sql2 = "select * from brand where id = '$edit_id'";
    $edit_result = $db->query($sql2);
    $edit_brand = mysqli_fetch_assoc($edit_result);
}

//Delete brand
if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "delete from brand where id = '$delete_id'";
    $db->query($sql);
    header('Location: brand.php');
}

//insert into brand databse
if(isset($_POST['add_submit'])){
    
    $brand = sanitize($_POST['brand']);
    
    //check if brand is blank
    if ($_POST['brand'] == ''){
        $errors[] .= 'You Must Entered Brand';
    }
    
    //check if brand exist in database
    $sql = "select * from brand where brand='$brand'";
    if(isset($_GET['edit'])){
        $sql = "select * from brand where brand = '$brand' and id != '$edit_id'";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);
    if ($count > 0){
        $errors[] .= $brand.' Already Exist. Please CHose Another Brand Name';
    }
    
    //Errors display
    if(!empty($errors)){
        echo display_errors($errors);
    }  else {
        //Add brand to databse
        $sql = "insert into brand(brand)values('$brand')";
        if(isset($_GET['edit'])){
            $sql = "update brand set brand='$brand' where id = '$edit_id'";
        }
        $db->query($sql);
        header('location: brand.php');
    }
}
?>
<h2 class="text-center">Brand</h2><hr>
<!--Insert brand data into database with form-->
<div class="text-center">
    <form class="form-inline" action="brand.php<?= ((isset($_GET['edit']))? '?edit='.$edit_id : ''); ?>" method="post">
        <div class="form-group">
            <?php
            $brand_value = '';
            if (isset($_GET['edit'])){
                $brand_value = $edit_brand['brand'];
            }  else {
                if (isset($_POST['brand'])){
                    $brand_value = sanitize($_POST['brand']);
                }
            }
            ?>
            <label for="brand"><?= ((isset($_GET['edit']))? 'Edit' : 'Add A'); ?> Brands</label>
            <input type="text" name="brand" id="brand" placeholder="Enter Brand" class="form-control" value="<?= $brand_value; ?>">
            <?php if (isset($_GET['edit'])):?>
            <a href="brand.php" class="btn btn-warning">Cancel</a>
            <?php endif;?>
            <input type="submit" name="add_submit" value="<?= ((isset($_GET['edit']))? 'Edit' : 'Add A'); ?> Brand" class="btn btn-success">
        </div>
    </form>
</div><hr>

<!--brand data show on table-->
<table class="table table-bordered table-striped table-responsive table-condensed" style="margin: 0 auto;margin-top: 20px;margin-bottom: 30px;">
    <thead>
    <th></th><th class="text-center">Brand</th><th></th>
    </thead>
    <tbody>
        <?php while ($brand = mysqli_fetch_assoc($result)):?>
        <tr class="text-center">
            <td><a href="brand.php?edit=<?= $brand['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-edit"></span></a></td>
            
            <td><?= $brand['brand'];?></td>
           
            <td><a href="brand.php?delete=<?= $brand['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
         <?php endwhile;?>
    </tbody>
</table>  
<?php 
include 'includes/footer.php';
ob_end_flush();
?>
