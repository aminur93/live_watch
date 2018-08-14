 </div><!--end content-->
</div><!--end pavel-->
	
	
<footer><!--start footer-->
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> ABOUT WATCH </h3>
                    <ul>
                        <li> <a href="#"> WHY US </a> </li>
                        <li> <a href="#"> TV ADVERTISE </a> </li>
                        <li> <a href="#"> VISIT OUR SHOWROOM </a> </li>
                        <li> <a href="#"> STUDENT DISCOUNT </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> CONTACT </h3>
                    <ul>
                        <li> <a href="#"> BY TELEPHONE </a> </li>
                        <li> <a href="#"> BY EMAIL </a> </li>
                        <li> <a href="#"> LOGIN/REGISTER </a> </li>
                        <li> <a href="#"> REPORT A BUG </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> RETURN/POLICIES </h3>
                    <ul>
                        <li> <a href="#"> RETURN POLICIES </a> </li>
                        <li> <a href="#"> DELIVERY POLICIES </a> </li>
                        <li> <a href="#"> SHIPPING LOCATION </a> </li>
                        <li> <a href="#"> VOUCHER/DISCOUNT </a> </li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-2 col-sm-4 col-xs-6">
                    <h3> INFORMATION </h3>
                    <ul>
                        <li> <a href="#"> WATCH REPAIRS & SERVICE </a> </li>
                        <li> <a href="#"> BRACELET ADJUSTMENT </a> </li>
                        <li> <a href="#"> Watch Buying Guide </a> </li>
                        <li> <a href="#"> WATCH NEWS </a> </li>
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3 col-sm-6 col-xs-12 ">
                    <h3> News Latter </h3>
                    <ul>
                        <li>
                            <div class="input-append newsletter-box text-center">
                                <input type="text" class="full text-center" placeholder="Email ">
                                <button class="btn  bg-gray" type="button"> Subscribe <i class="fa fa-long-arrow-right"> </i> </button>
                            </div>
                        </li>
                    </ul>
                    <ul class="social">
                        <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
                        <li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
                    </ul>
                </div>
            </div>
            <!--/.row--> 
        </div>
        <!--/.container--> 
    </div>
    <!--/.footer-->
    
    <div class="footer-bottom">
        <div class="container">
            <p class="text-center" style="line-height: 30px;"> Copyright © Watch Shop 2018. All right reserved. </p>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>

<!--details modal javascript function-->
<script>
    function detailsmodal(id){
        var data = {"id" : id};
        jQuery.ajax({
            url: '/final_project/includes/detailsmodal.php',
            method: "post",
            data: data,
            success: function(data){
                jQuery('body').append(data);
                jQuery('#details-modal').modal('toggle');
            },
            error: function(){
                alert("Something Went Wrong!");
            }
        });
    }

    function update_cart(mode,edit_id,edit_size){
        var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
        jQuery.ajax({
            url : '/final_project/admin/parsers/update_cart.php',
            method : "post",
            data : data,
            success : function(){location.reload();},
            error : function(){alert("Something Went Wrong!");}
        });
    }
    
    function add_to_cart() {
      jQuery('#modal_errors').html("");
      var size = jQuery('#size').val();
      var quantity = jQuery('#quantity').val();
      var available = jQuery('#available').val();
      var hand_size = jQuery('#hand_size').val();
      var error = '';
      var data = jQuery('#add_product_form').serialize();
      if (size == '' || quantity == '' || quantity == 0 || hand_size == ''){
          error += '<p class="text-center text-danger">You Must Chose size and quantity</p>';
          jQuery('#modal_errors').html(error);
          return;
      }else if (quantity > available){
          error += '<p class="text-center text-danger">There are only '+available+' available</p>';
          jQuery('#modal_errors').html(error);
          return;
      }else {
          jQuery.ajax({
              url: '/final_project/admin/parsers/add_cart.php',
              method: 'post',
              data: data,
              success: function () {
                  location.reload();
              },
              error: function () {
                  alert("something went wrong");
              }
          });
      }
    }

    function trailmodal(id){
        var data = {"id" : id};
        jQuery.ajax({
            url: '/final_project/includes/trailmodal.php',
            method: "post",
            data: data,
            success: function(data){
                jQuery('body').append(data);
                jQuery('#trail-modal').modal('toggle');
            },
            error: function(){
                alert("Something Went Wrong!");
            }
        });
    }
    
    </script>
 
</body>
</html>
