<?php
$sql = "select * from categories where parent=0";
$pquery = $db->query($sql);

$user_query = ((isset($_POST['user_query']))?sanitize($_POST['user_query']):'');
$cat_id = ((isset($_POST['cat']))?sanitize($_POST['cat']):'');
?>

<div class="navbar navbar-default" id="navbar"><!--start main navbar-->
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand home" href="index.php">
                <div class="col-xs-3"><i class="fa fa-object-group" style="font-size:30px;margin-top: 6px;margin-left: 15px;"></i></div>
                <div class="col-xs-9" style="margin-top:10px;">Watch Shop</div>
            </a><!--navbar brand home-->

            <button class="navbar-toggle" data-toggle="collapse" data-target="#navigation" type="button">
                    <span class="sr-only">Toggle Navigation</span>
                    <i class="fa fa-align-justify"></i>
            </button><!--end navbar toggle-->

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle Search</span>
                    <i class="fa fa-search"></i>
            </button><!--end seach navbar toggle-->
            
            </div><!--end navbar header-->
				
<div class="navbar-collapse collapse" id="navigation">
    <div class="padding-nav">
        <ul class="nav navbar-nav navbar-left">
            <?php while ($parent = mysqli_fetch_assoc($pquery)):?>
            <?php
            $parent_id = $parent['id'];
            $sql2 = "select * from categories where parent ='$parent_id'";
            $cquery = $db->query($sql2);
            ?>
            <!--Menu Items-->
            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category'];?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <?php while ($child = mysqli_fetch_assoc($cquery)):?>
                    <li><a href="category.php?cat=<?=$child['id'];?>"> <?php echo $child['category'];?></a></li>
                    <?php endwhile;?>
                </ul>
            </li>
            <?php endwhile;?>
            <?php
               if (isset($_SESSION['CBuser'])){
                $users_id = $_SESSION['CBuser'];
                $query = $db->query("select * from customer_user where id = '{$users_id}'");
                $customer_data = mysqli_fetch_assoc($query);
 
            ?>
            <li><a href="account.php"><img src="images/user/<?=$customer_data['image'];?>" alt="" style="margin-top: -8px;" width="30px;" class="img-thumbnail img-circle"> <?=$customer_data['fname'];?> </a></li>
            <?php } ?>
        </ul><!--end navbar nav navbar left-->
    </div><!--End Padding nav-->
    
					
<a href="cart.php" class="btn btn-default navbar-btn right"><i class="fa fa-shopping-cart"></i><span>&nbspCart (0)</span>
</a><!--end btn btn primary navbar-btn <right-->

<div class="navbar-collapse collapse right">
        <button type="button" class="btn navbar-btn btn-default" data-toggle="collapse" data-target="#search">
                <span class="sr-only">Toggle Search</span>
                <i class="fa fa-search"></i>
        </button>
</div><!--end navbar collapse collapse right-->

<div class="collapse clearfix" id="search">
    <form class="navbar-form" method="post" action="Asearch.php" enctype="multipart/form-data">
        <div class="input-group">
            <input type="hidden" name="cat" value="<?=$cat_id;?>">
            <input class="form-control" type="text" placeholder="search" name="user_query" value="<?=$user_query;?>">
            <span class="input-group-btn">
            <input type="submit" value="Go" class="btn btn-default">
                    <i class="fa fa-search"></i>
            </input>
            </span><!--end input group btn-->
        </div><!--end input group-->
    </form><!--end navbar form-->
</div><!--end collapse clearfix-->

    </div><!-- end navbar collapse-->
</div><!--end conatiner-->
</div><!--end navbar-->

