<?php
    ob_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/final_project/core/init.php';
    if (!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/top.php';
    
    //delete product
    if (isset($_GET['delete'])){
        $id = sanitize($_GET['delete']);
        $db->query("update products set deleted=1, featured=0 where id = '$id'");
        header('Location: product.php');
    }
    
    $dbpath = '';
    if (isset($_GET['add']) || isset($_GET['edit'])) {
        $brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
        $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
        $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
        $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
        $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
        $category = ((isset($_POST['child']) && !empty($_POST['child']) !='')?sanitize($_POST['child']):'');
        $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
        $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
        $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
        $product_keyword = ((isset($_POST['product_keyword']) && $_POST['product_keyword'] !='')?sanitize($_POST['product_keyword']):'');
        $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):'');
        $sizes = rtrim($sizes,',');
        $saved_image = '';
        if (isset($_GET['edit'])){
            $edit_id = (int)$_GET['edit'];
            $productResult = $db->query("select * from products where id = '$edit_id'");
            $product = mysqli_fetch_assoc($productResult);
            if (isset($_GET['delete_image'])){
                $imgi = (int)$_GET['imgi'] - 1;
                $images = explode(',',$product['image']);
                $image_url = $_SERVER['DOCUMENT_ROOT'].$images[$imgi];
                unset($image_url);
                unset($images[$imgi]);
                $imageString = implode(',',$images);
                $db->query("update products set image='{$imageString}' where id='$edit_id'");
                header('Location: product.php?edit='.$edit_id);
            }
            $category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):$product['categories']);
            $title = ((isset($_POST['title']) && $_POST['title'])?sanitize($_POST['title']):$product['title']);
            $brand = ((isset($_POST['brand']) && $_POST['brand'])?sanitize($_POST['brand']):$product['brand']);
            $price = ((isset($_POST['price']) && $_POST['price'])?sanitize($_POST['price']):$product['price']);
            $list_price = ((isset($_POST['list_price']))?sanitize($_POST['list_price']):$product['list_price']);
            $description = ((isset($_POST['description']))?sanitize($_POST['description']):$product['description']);
            $product_keyword = ((isset($_POST['product_keyword']) && !empty($_POST['product_keyword']))?sanitize($_POST['product_keyword']):$product['product_keyword']);
            $sizes = ((isset($_POST['sizes']) && $_POST['sizes'])?sanitize($_POST['sizes']):$product['sizes']);
            $sizes = rtrim($sizes,',');
            $saved_image = (($product['image'] != '')?$product['image']:'');
            $parentQ = $db->query("select * from categories where id = '$category'");
            $parentResult = mysqli_fetch_assoc($parentQ);
            $parent = ((isset($_POST['parent']) && $_POST['parent'])?sanitize($_POST['parent']):$parentResult['parent']);
            $dbpath = $saved_image;
        }
        if (!empty($sizes)) {
            $sizeString = sanitize($sizes);
            $sizeString = rtrim($sizeString,',');
            $sizesArray = explode(',',$sizeString);
            $sArray = array();
            $qArray = array();
            $tArray = array();
            foreach ($sizesArray as $ss) {
                $s = explode(':', $ss);
                $sArray[] = $s[0];
                $qArray[] = $s[1];
                $tArray[] = $s[2];
            }
        } else {
            $sizesArray = array();
        }
        if ($_POST) {
            $errors = array();
            $required = array('title', 'brand', 'price', 'parent', 'child', 'sizes');
            $allowed = array('png','jpg','jpeg','gif');
            $tmpLoc = array();
            $uploadPath = array();
            foreach ($required as $field) {
                if ($_POST[$field] == '') {
                    $errors[] = 'All Fields With and Astrisk are required';
                    break;
                }
            }
            $photoCount = count($_FILES['photo']['name']);
            if ($photoCount > 0) {
                for ($i=0;$i<$photoCount;$i++) {
                    $name = $_FILES['photo']['name'][$i];
                    $nameArray = explode('.', $name);
                    $fileName = $nameArray[0];
                    $fileExt = $nameArray[1];
                    $mime = explode('/', $_FILES['photo']['type'][$i]);
                    $mimeType = $mime[0];
                    $mimeExt = $mime[1];
                    $tmpLoc[] = $_FILES['photo']['tmp_name'][$i];
                    $fileSize = $_FILES['photo']['size'][$i];
                    $uploadName = md5(microtime().$i).'.'.$fileExt;
                    $uploadPath[] = BASEURL.'images/watch/'.$uploadName;
                    if ($i != 0) {
                        $dbpath .= ',';
                    }
                    $dbpath .= '/final_project/images/watch/'.$uploadName;
                    if ($mimeType != 'image') {
                        $errors[] = 'The file must be an image.';
                    }
                    if (!in_array($fileExt,$allowed)){
                        $errors[] = 'The file extenson must be an png, jpg, jpeg or gif';
                    }
                    if ($fileSize>15000000){
                        $errors[] = 'The file size must be under 15mb';
                    }
                    if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
                        $errors[] = 'The file Extenson does not match!';
                    }
                }
            }
            if (!empty($errors)) {
                echo display_errors($errors);
            } else {
                //upload file and insert into database
                if ($photoCount > 0) {
                    for ($i=0;$i<$photoCount;$i++) {
                        move_uploaded_file($tmpLoc[$i], $uploadPath[$i]);
                    }
                }
                $insertSql = "INSERT INTO products (`title`,`price`,`list_price`,`brand`,`categories`,`sizes`,`image`,`description`,`product_keyword`)
                VALUES ('$title','$price','$list_price','$brand','$category','$sizes','$dbpath','$description','$product_keyword')";
                if (isset($_GET['edit'])){
                    $insertSql = "update products set title = '$title', price = '$price', list_price = '$list_price',
                  brand = '$brand', categories = '$category', sizes = '$sizes', image = '$dbpath', description = '$description', product_keyword='$product_keyword'
                  where id = '$edit_id'";
                }
                $db->query($insertSql);
                header('Location: product.php');
            }
        }
    ?>
<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add A New')?> Product</h2><hr>
<form action="product.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data">
    <div class="form-group col-md-3">
        <label for="title">Title: </label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $title;?>">
    </div>
    
    <div class="form-group col-md-3">
        <label for="brand">Brand: </label>
        <select class="form-control" id="brand" name="brand">
            <option value=""<?= (($brand == '')?' selected':'');?>>~~select~~</option>
            <?php while ($b = mysqli_fetch_assoc($brandQuery)):?>
            <option value="<?= $b['id'];?>"<?= (($brand == $b['id'])?' selected':'');?>><?= $b['brand'];?></option>
            <?php endwhile;?>
        </select>
    </div>
    
    <div class="form-group col-md-3">
        <label for="parent">parent category:</label>
        <select class="form-control" id="parent" name="parent">
            <option value=""<?=(($parent == '')?' selected':'')?>>~~select~~</option>
            <?php while ($p = mysqli_fetch_assoc($parentQuery)):?>
             <option value="<?=$p['id'];?>"<?=(($parent == $p['id'])?' selected':'')?>><?=$p['category'];?></option>
            <?php endwhile;?>
        </select>
    </div>
    
    <div class="form-group col-md-3">
        <label for="child">Child:</label>
        <select class="form-control" id="child" name="child">
        
        </select>
    </div>
    
    <div class="form-group col-md-3">
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" class="form-control" value="<?=$price;?>">
    </div>
    
    <div class="form-group col-md-3">
        <label for="list_price">List Price:</label>
        <input type="text" id="list_price" name="list_price" class="form-control" value="<?=$list_price;?>">
    </div>
    
    <div class="from-group col-md-3">
        <label>Quantity & Sizes: </label>
        <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity & Sizes</button>
    </div>
    
    <div class="form-group col-md-3">
        <label for="sizes">Sizes & Qty Preview</label>
        <input type="text" name="sizes" id="sizes" class="form-control" value="<?=$sizes;?>" readonly>
    </div>
    
    <div class="form-group col-md-6">
        <?php if ($saved_image != ''):?>
            <?php
            $imgi = 1;
            $images = explode(',',$saved_image);
            ?>
            <?php foreach ($images as $image):?>
        <div class="saved-image col-md-4">
            <img src="<?=$image;?>"><br>
            <a href="product.php?delete_image=1&edit=<?=$edit_id;?>&imgi=<?=$imgi;?>" class="text-danger">Delete Image</a>
        </div>
             <?php
              $imgi++;
              endforeach;
              ?>
        <?php else:?>
        <label for="photo">Product Photo: </label>
        <input type="file" name="photo[]" id="photo" class="form-control" multiple>
            <?php endif;?>
    </div>
    
    <div class="form-group col-md-6">
        <label for="product_keyword">Product Keyword: </label>
        <input type="text" class="form-control" name="product_keyword" id="product_keyword" value="<?=$product_keyword;?>">
    </div>
    
    <div class="form-group col-md-6">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control" rows="6"><?=$description;?></textarea>
    </div>
    
    <div class="form-group pull-right" style="margin-right: 10px;">
        <a href="product.php" class="btn btn-default">Canncel</a>
        <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add')?> Product" class="btn btn-success" >
    </div><div class="clearfix"></div>
</form>
    <!--Modal-->
    <div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="sizesModalLabel">Size & Quantity</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?php for ($i=1;$i <= 12;$i++):?>
                            <div class="form-group col-sm-2">
                                <label for="size<?=$i;?>">Size: </label>
                                <input type="text" name="size<?=$i;?>" id="size<?=$i;?>" value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
                            </div>
                            
                            <div class="form-group col-sm-2">
                                <label for="qty<?=$i;?>">Quantity: </label>
                                <input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" class="form-control">
                            </div>
    
                            <div class="form-group col-sm-2">
                                <label for="threshold<?=$i;?>">Threshold: </label>
                                <input type="number" name="threshold<?=$i;?>" id="threshold<?=$i;?>" value="<?=((!empty($tArray[$i-1]))?$tArray[$i-1]:'');?>" min="0" class="form-control">
                            </div>
                        <?php endfor;?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php }else {
   
//product data retrive from databse
$sql = "select * from products where deleted=0";
$product_result = $db->query($sql);

//featured product 
if (isset($_GET['featured'])) {
    $id = (int)$_GET['id'];
    $featured = (int)$_GET['featured'];
    $featuredsql = "update products set featured='$featured' where id='$id'";
    $db->query($featuredsql);
    header('location: product.php');
}
?>

<!--product data show on table-->
<h2 class="text-center">Products</h2>
<!--product data show on table-->
<a href="product.php?add=1" class="btn btn-primary pull-right" id="add-product-btn" style="margin-top:-35px;margin-right: 10px;">Add Product</a><div class="clearfix"></div>
<hr>
<table class="table table-bordered table-condensed table-striped table-responsive" style="margin: 0 auto;margin-bottom: 10px;">
    <thead>
    <th></th>
    <th>Product</th>
    <th>Price</th>
    <th>Category</th>
    <th>Featured</th>
    <th>Sold</th>
    </thead>
    <tbody>
        <?php while ($product = mysqli_fetch_assoc($product_result)):
            $childId = $product['categories'];
            $catsql = "select * from categories where id='$childId'";
            $result = $db->query($catsql);
            $child = mysqli_fetch_assoc($result);
            $parentId = $child['parent'];
            $psql = "select * from categories where id='$parentId'";
            $presult = $db->query($psql);
            $parent = mysqli_fetch_assoc($presult);
            $category = $parent['category'].'-'.$child['category'];
            ?>
        <tr>
            <td>
                <a href="product.php?edit=<?= $product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-edit"></span></a>
                <a href="product.php?delete=<?= $product['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
            </td>
            <td><?= $product['title'];?></td>
            <td><?= money($product['price']);?></td>
            <td><?= $category;?></td>
            <td>
                <a href="product.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
                <span class="glyphicon glyphicon-<?=(($product['featured']==1)?'minus':'plus');?>"></span>
                </a>&nbsp<?=(($product['featured']==1)?'featured product':'');?></td>
            <td>0</td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>
<?php } ?>
<?php include 'includes/footer.php'; ob_end_flush();?>
<script>
    jQuery('document').ready(function () {
       get_child_options('<?=$category;?>');
    });
</script>

