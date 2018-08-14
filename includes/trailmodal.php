<?php
    require_once '../core/init.php';
    $id = $_POST['id'];
    $id = (int)$id;
    $sql = "select * from products where id='$id'";
    $result = $db->query($sql);
    $product = mysqli_fetch_assoc($result);
    
    //brand data retrive from database
    $brand_id = $product['brand'];
    $sql = "select brand from brand where id = '$brand_id'";
    $brand_query = $db->query($sql);
    $brand = mysqli_fetch_assoc($brand_query);
    
    //product sizes data retrive from database
    $sizestring = $product['sizes'];
    $sizestring = rtrim($sizestring,',');
    $size_array = explode(',', $sizestring);
    
    //trial image form database
    if (isset($_SESSION['CBuser'])) {
        $users_id = $_SESSION['CBuser'];
        $sql = "select t.id, t.users_id, t.image, c.fname, c.lname, c.email
                 from trial t
                 LEFT JOIN customer_user c ON t.users_id = c.id
                 where c.id = '$users_id'
                 ";
        $trial_query = $db->query($sql);
    }
    
?>
<!--Trails Modal-->
<?php ob_start();?>
<div class="modal fade trail" id="trail-modal" tabindex="-1" role="dailog" aria-labellby="trail" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="trial">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" onclick="closeModal()" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="js-title-step"></h4>
            </div>
                <div class="modal-body moc">
                    <div class="container-fluid">
                        <div class="row hide" data-step="1" data-title="Customize Your Watch">
                            
                            <div class="wells">
                                <div class="col-sm-4 fotorama">
                                    <?php
                                        $photos = explode(',',$product['image']);
                                        foreach ($photos as $photo):
                                    ?>
                                    <div class="center-block">
                                        <img src="<?= $photo; ?>" height="300px" width="200px" style="margin: 20px auto;width: 49%;" class="details img-responsive">
                                    </div>
                                    <?php endforeach;?>
                                </div>
                                
                                <div class="col-sm-6">
                                   
                                    <div id='results'></div>
                                    
                                    <div id='my_camera'></div>
                                    
                                </div>
                                
                                <div class="col-sm-2">
                                    <h3>Details</h3>
                                    <hr>
                                    <p><?= $product['description']; ?></p>
                                    <hr>
                                    <p><b>Price</b>: $<?= $product['price']; ?></p>
                                    <p><b>Brand</b>: <?= $brand['brand'];?></p>
                                </div>
                            </div><!--Modal Step1-->
                        </div><!--end first step-->
                
                <div class="row hide" data-step="2" data-title="Set Watch on Image & Click On Add Cart">
                    <div class="wells">
                        <span id="modal_errors" class="bg-danger"></span>
                        <div class="col-sm-6">
                            
                            <div id="draggable" class="ui-widget-content">
                                <?php $photos = explode(',',$product['image']);?>
                               <img src="<?= $photos[0]; ?>" style="margin: 20px auto;width: 10%;float: left;" class="img details img-responsive">
                            </div>
                       
                            <div id="droppable" class="ui-widget-header">
                                <?php while ($trial = mysqli_fetch_assoc($trial_query)):?>
                               <img src="<?=$trial['image'];?>"  width="200" height="250" style="float:left;margin-left: 80px;">
                                <?php endwhile;?>
                            </div>
                            
                        </div>
    
                        <div class="col-sm-6">
                            <h4>Details</h4>
                            <p><?= $product['description']; ?></p>
                            <hr>
                            <p>Price: $<?= $product['price']; ?></p>
                            <p>Brand: <?= $brand['brand'];?></p>
                            <form action="add_cart.php" method="post" id="add_product_form">
                                <input type="hidden" name="product_id" value="<?=$id;?>">
                                <input type="hidden" name="available" id="available" value="">
                                
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="quantity">Quantity: </label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" min="0">
                                    </div>
                                </div>
                                <br><br><br><br>
                                
                                <div class="form-group">
                                    <label for="hand_size">Hand Ribs Size: </label>
                                    <select name="hand_size" id="hand_size" class="form-control">
                                        <?php
                                        $sql = "select * from handsize order by id desc";
                                        $hand_query = $db->query($sql);
                                        while ($row = mysqli_fetch_assoc($hand_query)){
                                            $hand_size = $row['hand_size'];
                                            echo "<option value='$hand_size'>$hand_size</option>";
                                        }
                                        ?>
                                        
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="size">Size: </label>
                                    <select name="size" id="size" class="form-control">
                                        <option value="">~~select~~</option>
                                        <?php
                                            foreach ($size_array as $string){
                                                $string_array = explode(':', $string);
                                                $size = $string_array[0];
                                                $available = $string_array[1];
                                                if ($available > 0) {
                                                    echo '<option value="' . $size . '" data-available="' . $available . '">' . $size . ' (' . $available . ' Available)</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </form><!--end <form-->
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div><!--end second step-->
            </div>
        </div>
<div class="modal-footer">
    <button class="btn btn-default js-btn-step pull-left" onclick="closeModal()">Close</button>
    <form method="post" enctype="multipart/form-data" id="form1" style="display: inline-block;">
    <input type="hidden" name="users_id" value="<?=$users_id;?>">
    <button class="btn btn-warning" onclick="take_snapshot()" id="demo"><span class="glyphicon glyphicon-camera"></span> Take A Picture</button>
    </form>
    <button type="button" style="display: none;" id="pre" onclick="back()" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
    <button type="button" id="nxt" onclick="myfunction();return false;" class="btn btn-success js-btn-step" data-orientation="next"></button>
    <button class="btn btn-primary" id="show" onclick="add_to_cart();return false;" style="display: none;"><span class="glyphicon glyphicon-shopping-cart"></span> Add Cart</button>
</div>
        </div>
    </div>
</div>

<script>
    $( "form" ).submit(function( event ) {
        event.preventDefault();
    });

    jQuery('#size').change(function () {
        var available = jQuery('#size option:selected').data("available");
        jQuery('#available').val(available);
    });

    $(function () {
        $('.fotorama').fotorama({'loop':true,'autoplay':true});
    });
    
    function closeModal(){
        jQuery('#trail-modal').modal('hide');
        setTimeout(function(){
            jQuery('#trail-modal').remove();
            jQuery('.modal-backdrop').remove();
        },500);
    }

    Webcam.set({
        width: 300,
        height: 300,
        image_format: 'jpeg',
        jpeg_quality: 90,
        force_flash: false
    });
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        
        // take snapshot and get image data
        Webcam.snap(function (data_uri) {
            // display results in page
           
            document.getElementById('results').innerHTML =
                '<h3>Here is your image....</h3>' +
                '<img src="' +data_uri+ '" width=\'280px\' height=\'250px\'/>';
            
            Webcam.upload(data_uri, 'saveimages.php', function (code, text) {
                    alert("Successfull");
            });
        });
        Webcam.reset();
    }
    
    function myfunction() {
        document.getElementById("demo").style.display = "none";
        document.getElementById("nxt").style.display = "none";
        document.getElementById("show").style.display = "inline-block";
        document.getElementById("pre").style.display = "inline-block";
        
    }
    function back() {
        document.getElementById("demo").style.display = "inline-block";
        document.getElementById("pre").style.display = "none";
        document.getElementById("show").style.display = "none";
        document.getElementById("nxt").style.display = "inline-block";
    }
    
    $('#trail-modal').modalSteps();
    
</script>

<script type="text/javascript">
    $( function() {
        $( "#draggable" ).draggable();
        $( "#droppable" ).droppable({
            drop: function( event, ui ) {
                $( this )
                    .addClass( "ui-state-highlight" )
                    .find( "img" )
                    .html( "Dropped!" );
            }
        });
    } );
    
    $(document).ready(function() {
        
        
        var degrees = 0;
        $('.img').click(function rotateMe(e) {
            
            degrees += 90;
            
            //$('.img').addClass('rotated'); // for one time rotation
            
            $('.img').css({
                
                'transform': 'rotate(' + degrees + 'deg)',
                '-ms-transform': 'rotate(' + degrees + 'deg)',
                '-moz-transform': 'rotate(' + degrees + 'deg)',
                '-webkit-transform': 'rotate(' + degrees + 'deg)',
                '-o-transform': 'rotate(' + degrees + 'deg)'
            });
            
        })
        
    });
    
</script>





