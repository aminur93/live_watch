<h3 class="text-center">Recent Items</h3>
<?php
    /**
     * Created by PhpStorm.
     * User: pavel
     * Date: 4/24/2018
     * Time: 2:27 AM
     */
    $tranQ = $db->query("select * from cart where paid=0 ORDER BY id DESC LIMIT 5");
    $result = array();
    while ($row = mysqli_fetch_assoc($tranQ)){
        $result[] = $row;
    }
    $row_count = $tranQ->num_rows;
    $used_ids = array();
    for ($i=0;$i<$row_count;$i++){
        $json_items = $result[$i]['items'];
        $items = json_decode($json_items,true);
        foreach ($items as $item){
            if (!in_array($item['id'], $used_ids)){
                $used_ids[] = $item['id'];
            }
        }
    }
?>
<div id="recent_widget">
    <table class="table table-condensed">
        <?php foreach ($used_ids as $id):
            $productQ = $db->query("select id,title from products where id = '{$id}'");
            $product = mysqli_fetch_assoc($productQ);
            ?>
            <tr>
                <td><?=substr($product['title'],0,10);?></td>
                <td>
                    <a class="text-primary" onclick="detailsmodal('<?=$id;?>')" style="cursor: pointer;">View</a>
                </td>
            </tr>
        
        <?php endforeach;?>
    </table>
</div>