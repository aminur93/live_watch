<div class="row">
                <footer id="admin-footer" class="clearfix">
                    <div class="pull-left"><b>Copyright </b>&copy; 2018 Develop By Aminur Rashid</div>
                    <div class="pull-right">Admin System</div>
                </footer>
            </div><!--end second row-->
        </div><!--End col-md-10 -->
    </div><!--End main row-->
</div><!--End Container-->
<script>
    function updateSizes() {
        var sizeString='';
        for (var i=1;i<=12;i++){
        if (jQuery('#size'+i).val() != ''){
        sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+':'+jQuery('#threshold'+i).val()+',';
        }
        }
        jQuery('#sizes').val(sizeString);
    }
    
    function get_child_options(selected) {
        if (typeof selected === 'undefined'){
            var selected = '';
        }
        var parentID = jQuery('#parent').val();
        jQuery.ajax({
            url:'parsers/child_categories.php',
            type:'POST',
            data:{parentID : parentID, selected: selected},
            success: function (data) {
              jQuery('#child').html(data);
            },
            error: function(){
                alert("something is wrong with the child option")},
        });
    }
    jQuery('select[name="parent"]').change(function () {
        get_child_options();
    });
</script>
</body>
</html>
