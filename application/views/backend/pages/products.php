<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="section-subtitle"><b>PRODUCTS</b></h4>
                        <div style="color:red; font-size: 22px;" id="flashdata">
                            <?php
                            if($this->session->flashdata('msg')){
                                print $this->session->flashdata('msg');
                                $this->session->set_flashdata('msg', '');
                            }
                            ?>
                        </div>
                        <div class="panel">
                            <div class="panel-content">
                                <table id="responsive-table" class="data-table table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Type</th>
                                            <th>Frame</th>
                                            <th>Brand</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($products)){ 
                                         foreach($products as $product){
                                        ?>
                                        <tr style="height: 60px;">
                                            <td>
                                                <?=$product['name']?>
                                            </td>
                                            <td>
                                                <?php if($product['primary_image'] != ''){ ?>
                                                <img src="<?=base_url('assets/images/productImage/'.$product['primary_image'])?>" style="height: 100px;">
                                                <?php } ?>
                                            </td>
                                            <td><?=$product['cat_name']?></td>
                                            <td><?=$product['spec_name']?></td>
                                            <td><?=$product['frame_name']?></td>
                                            <td><?=$product['brand_name']?></td>
                                            <td>
                                                <a href="javascript:void(0)" id="<?=$product['id']?>" class="change-status" data-table="products" data-url="admin/change-status" title="Status | Green:Active, Red:InActive">
                                                    <?php if($product['status'] == 1){ ?>
                                                    <span class="glyphicon glyphicon-ok-sign green-check-icon"></span>
                                                    <?php } else { ?>
                                                    <span class="glyphicon glyphicon-remove-sign red-check-icon"></span>
                                                    <?php } ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?=base_url('admin/edit-product/'.$product['id'])?>">
                                                    <i class="fa fa-edit" aria-hidden="false" title="Edit Product"></i>
                                                </a>
                                                <a href="<?=base_url('admin/add-product-attribute/'.$product['id'])?>">
                                                    <i class="fa fa-indent" aria-hidden="true" title="Add Product Attribute"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } }else{ ?>
                                        <tr style="height:50px; text-align: center; font-weight: bolder;">
                                            <td colspan="8">No Product Found !!!</td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
