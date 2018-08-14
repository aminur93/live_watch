<div class="col-md-2 col-sm-1 hidden-xs display-table-cell valign-top" id="side-menu">
            <h1 class="hidden-xs hidden-sm">Admin Panel</h1>
            <ul>
                <li class="link active">
                    <a href="/final_project/admin/index.php">
                        <span class="glyphicon glyphicon-th" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">DashBorad</span>
                    </a>
                </li>
                
                <li class="link">
                    <a href="#collapse-brand" data-toggle="collapse" aria-controls="collapse-brand">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">Brand</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-brand">
                        <li><a href="brand.php">Add Brand</a></li>
                    </ul>
                </li>
    
                <li class="link">
                    <a href="#collapse-ribs" data-toggle="collapse" aria-controls="collapse-ribs">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">Hand Ribs Size</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-ribs">
                        <li><a href="hand_ribs.php">Add Hand Ribs</a></li>
                    </ul>
                </li>
    
                <li class="link">
                    <a href="#collapse-category" data-toggle="collapse" aria-controls="collapse-category">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">Category</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-category">
                        <li><a href="categories.php">Add Category</a></li>
                    </ul>
                </li>
                
                <li class="link">
                    <a href="#collapse-product" data-toggle="collapse" aria-controls="collapse-product">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">Product</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-product">
                        <li><a href="product.php">Add Product</a></li>
                    </ul>
                </li>
    
                <li class="link">
                    <a href="#collapse-archive" data-toggle="collapse" aria-controls="collapse-archive">
                        <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">Archive</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-archive">
                        <li><a href="archive.php">Archive Product</a></li>
                    </ul>
                </li>
    
                <li class="link">
                    <a href="#collapse-user" data-toggle="collapse" aria-controls="collapse-user">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">User</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-user">
                        <?php if (has_permission('admin')):?>
                        <li><a href="users.php">Add User</a></li>
                        <?php endif;?>
                    </ul>
                </li>
    
                <li class="link">
                    <a href="#collapse-customer" data-toggle="collapse" aria-controls="collapse-customer">
                        <span class="glyphicon glyphicon-queen" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">Customer</span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-customer">
                        <?php if (has_permission('admin')):?>
                            <li><a href="customer.php">View Customer</a></li>
                        <?php endif;?>
                    </ul>
                </li>
                
                <li class="link">
                    <a href="#collapse-admin" data-toggle="collapse" aria-controls="collapse-admin">
                        <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">Hello <?=$user_data['first'];?></span>
                    </a>
                    <ul class="collapse collapseable" id="collapse-admin">
                        <li><a href="change_password.php">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
    
                <li class="link settings-btn">
                    <a href="settings.php">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        <span class="hidden-sm hidden-xs">Settings</span>
                    </a>
                </li>
            </ul>
        </div><!--End col-md-2 -->
