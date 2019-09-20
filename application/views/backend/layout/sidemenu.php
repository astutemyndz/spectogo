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
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'product-management' || $this->uri->segment(2) == 'add-product' || $this->uri->segment(2) == 'edit-product'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Product Management</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-product'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-product')?>">Add Product</a></li>
                            <li <?php if($this->uri->segment(2) == 'product-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/product-management')?>">Product List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'lens-management' || $this->uri->segment(2) == 'add-lens' || $this->uri->segment(2) == 'edit-lens'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Lens Category</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-lens'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-lens')?>">Add Lens Category</a></li>
                            <li <?php if($this->uri->segment(2) == 'lens-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/lens-management')?>">Lens Category List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'lens-sub-category-management' || $this->uri->segment(2) == 'add-lens-sub-category' || $this->uri->segment(2) == 'edit-lens-sub-category'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Lens Sub-Category</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-lens-sub-category'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-lens-sub-category')?>">Add Lens Sub-Category</a></li>
                            <li <?php if($this->uri->segment(2) == 'lens-sub-category-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/lens-sub-category-management')?>">Lens Sub-Category List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'pupillary-distance' || $this->uri->segment(2) == 'add-pupillary-distance' || $this->uri->segment(2) == 'edit-pupillary-distance'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Pupillary Distance</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-pupillary-distance'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-pupillary-distance')?>">Add Pupillary Distance</a></li>
                            <li <?php if($this->uri->segment(2) == 'pupillary-distance'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/pupillary-distance')?>">Pupillary Distance List</a></li>
                        </ul>
                    </li>

                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'lenses-and-tints' || $this->uri->segment(2) == 'add-lenses-and-tints' || $this->uri->segment(2) == 'edit-lenses-and-tints'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Lenses & Tints</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-lenses-and-tints'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-lenses-and-tints')?>">Add Lenses & Tints</a></li>
                            <li <?php if($this->uri->segment(2) == 'lenses-and-tints'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/lenses-and-tints')?>">Lenses & Tints List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'lenses-and-tints-details' || $this->uri->segment(2) == 'add-lenses-and-tints-details' || $this->uri->segment(2) == 'edit-lenses-and-tints-details'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Lenses & Tints Details</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-lenses-and-tints-details'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-lenses-and-tints-details')?>">Add Lenses & Tints Details</a></li>
                            <li <?php if($this->uri->segment(2) == 'lenses-and-tints-details'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/lenses-and-tints-details')?>">Lenses & Tints Details List</a></li>
                        </ul>
                    </li>
                    <li class="has-child-item close-item <?php if($this->uri->segment(2) == 'reglaze-management' || $this->uri->segment(2) == 'add-reglaze' || $this->uri->segment(2) == 'edit-reglaze'){ ?> active-item <?php } ?>">
                        <a><i class="fa fa-pie-chart" aria-hidden="true"></i><span>Reglaze Details</span> </a>
                        <ul class="nav child-nav level-1">
                            <li <?php if($this->uri->segment(2) == 'add-reglaze'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/add-reglaze')?>">Add Reglaze Details</a></li>
                            <li <?php if($this->uri->segment(2) == 'reglaze-management'){ ?> class="active-item" <?php } ?>><a href="<?=base_url('admin/reglaze-management')?>">Reglaze Details List</a></li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>
