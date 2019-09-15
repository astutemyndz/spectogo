<div class="left-sidebar">
    <div class="left-sidebar-header">
        <div class="left-sidebar-title">Navigation</div>
        <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
            <span></span>
        </div>
    </div>
    <div id="left-nav" class="nano">
        <div class="nano-content">
            <nav>
                <ul class="nav nav-left-lines" id="main-nav">
                    <li <?php if($this->uri->segment(2) == 'dashboard'){ ?> class="active-item" <?php } ?>>
                        <a href="<?=base_url('admin/dashboard')?>">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'category-management' || $this->uri->segment(2) == 'add-category' || $this->uri->segment(2) == 'edit-category'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Category Management</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-category'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-category')?>">Add Category</a></li>
                            <li <?php if($this->uri->segment(2) == 'category-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/category-management')?>"> Category</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'banner-management' || $this->uri->segment(2) == 'add-banner'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Banner Management</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-banner'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-banner')?>">Add Banner</a></li>
                            <li <?php if($this->uri->segment(2) == 'banner-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/banner-management')?>">Banner List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'specs-management' || $this->uri->segment(2) == 'add-specs' || $this->uri->segment(2) == 'edit-specs'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Specs Management</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-specs'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-specs')?>">Add Specs Type</a></li>
                            <li <?php if($this->uri->segment(2) == 'specs-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/specs-management')?>">Specs Type List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'frame-management' || $this->uri->segment(2) == 'add-frame' || $this->uri->segment(2) == 'edit-frame'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Frame Management</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-frame'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-frame')?>">Add Frame</a></li>
                            <li <?php if($this->uri->segment(2) == 'frame-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/frame-management')?>">Frame List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'brand-management' || $this->uri->segment(2) == 'add-brand' || $this->uri->segment(2) == 'edit-brand'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Brand Management</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-brand'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-brand')?>">Add Brand</a></li>
                            <li <?php if($this->uri->segment(2) == 'brand-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/brand-management')?>">Brand List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'product-management' || $this->uri->segment(2) == 'add-product' || $this->uri->segment(2) == 'product-brand'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Product Management</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-product'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-product')?>">Add Product</a></li>
                            <li <?php if($this->uri->segment(2) == 'product-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/product-management')?>">Product List</a></li>
                        </ul>
                    </li>




                    <!--<li <?php if($this->uri->segment(2) == 'banner-management'){ ?> class="active-item" <?php } ?>>
    <a href="<?=base_url('admin/banner-management')?>">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Banner Management</span>
    </a>
</li>-->









                </ul>
            </nav>
        </div>
    </div>
</div>
