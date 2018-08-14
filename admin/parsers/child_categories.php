<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 2/20/2018
     * Time: 2:16 PM
     */
    require_once $_SERVER['DOCUMENT_ROOT'].'/final_project/core/init.php';
    $parentID = (int)$_POST['parentID'];
    $selected = sanitize($_POST['selected']);
    $childquery = $db->query("select * from categories where parent='$parentID' ORDER BY category");
    ob_start();
    ?>
    <option value=""></option>
    <?php while ($child = mysqli_fetch_assoc($childquery)):?>
        <option value="<?=$child['id'];?>"<?=(($selected == $child['id'])?' selected':'');?>><?=$child['category'];?></option>
    <?php endwhile;?>
<?php echo ob_get_clean();?>
