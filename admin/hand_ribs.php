<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/23/2018
     * Time: 11:36 PM
     */
    ob_start();
    require_once '../core/init.php';
    if (!is_logged_in()){
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/top.php';
    
    //get brand from database
    $sql = "select * from handsize order by id ASC";
    $result = $db->query($sql);
    $errors = array();
    
    //Edit Brand
    if (isset($_GET['edit']) && !empty($_GET['edit'])){
        $edit_id = (int)$_GET['edit'];
        $edit_id = sanitize($edit_id);
        $sql2 = "select * from handsize where id = '$edit_id'";
        $edit_result = $db->query($sql2);
        $edit_ribs = mysqli_fetch_assoc($edit_result);
    }

//Delete brand
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $sql = "delete from handsize where id = '$delete_id'";
        $db->query($sql);
        header('Location: hand_ribs.php');
    }

//insert into brand databse
    if(isset($_POST['add_submit'])){
        
        $hand_size = sanitize($_POST['hand_size']);
        
        //check if hand size is blank
        if ($_POST['hand_size'] == ''){
            $errors[] .= 'You Must Entered Hand Ribs';
        }
        
        //check if hand size exist in database
        $sql = "select * from handsize where hand_size ='$hand_size'";
        if(isset($_GET['edit'])){
            $sql = "select * from handsize where hand_size = '$hand_size' and id != '$edit_id'";
        }
        $result = $db->query($sql);
        $count = mysqli_num_rows($result);
        if ($count > 0){
            $errors[] .= $hand_size.' Already Exist. Please CHose Another hand Size';
        }
        
        //Errors display
        if(!empty($errors)){
            echo display_errors($errors);
        }  else {
            //Add brand to databse
            $sql = "insert into handsize(hand_size)values('$hand_size')";
            if(isset($_GET['edit'])){
                $sql = "update handsize set hand_size='$hand_size' where id = '$edit_id'";
            }
            $db->query($sql);
            header('location: hand_ribs.php');
        }
    }
    ?>
    <h2 class="text-center">Hand Ribs Size</h2><hr>
    <!--Insert brand data into database with form-->
    <div class="text-center">
        <form class="form-inline" action="hand_ribs.php<?= ((isset($_GET['edit']))? '?edit='.$edit_id : ''); ?>" method="post">
            <div class="form-group">
                <?php
                    $ribs_value = '';
                    if (isset($_GET['edit'])){
                        $ribs_value = $edit_ribs['hand_size'];
                    }  else {
                        if (isset($_POST['hand_size'])){
                            $ribs_value = sanitize($_POST['hand_size']);
                        }
                    }
                ?>
                <label for="hand_size"><?= ((isset($_GET['edit']))? 'Edit' : 'Add A'); ?> Hand Ribs</label>
                <input type="text" name="hand_size" id="hand_size" placeholder="Enter Hand Ribs" class="form-control" value="<?= $ribs_value; ?>">
                <?php if (isset($_GET['edit'])):?>
                    <a href="hand_ribs.php" class="btn btn-warning">Cancel</a>
                <?php endif;?>
                <input type="submit" name="add_submit" value="<?= ((isset($_GET['edit']))? 'Edit' : 'Add A'); ?> hand Ribs" class="btn btn-success">
            </div>
        </form>
    </div><hr>
    
    <!--brand data show on table-->
    <table class="table table-bordered table-striped table-responsive table-condensed" style="margin: 0 auto;margin-top: 20px;margin-bottom: 30px;">
        <thead>
        <th></th><th class="text-center">Hand Ribs</th><th></th>
        </thead>
        <tbody>
        <?php while ($ribs = mysqli_fetch_assoc($result)):?>
            <tr class="text-center">
                <td><a href="hand_ribs.php?edit=<?= $ribs['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-edit"></span></a></td>
                
                <td><?= $ribs['hand_size'];?></td>
                
                <td><a href="hand_ribs.php?delete=<?= $ribs['id'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
        <?php endwhile;?>
        </tbody>
    </table>
<?php
    include 'includes/footer.php';
    ob_end_flush();
    ?>