<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="section-subtitle"><b>LENS AND TINTS DETAILS</b></h4>
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
                                <table id="responsive-table" class="table data-table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Lens And Tints Sub Category Name</th>
                                            <th>Image</th>
                                            <th>Lens And Tints Category Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($lens)){ 
                                         foreach($lens as $lenss){
                                        ?>
                                        <tr style="height: 60px;">
                                            <td>
                                                <?=$lenss['lensandtint_sub_cat_name']?>
                                            </td>
                                            <td>
                                                <img src="<?=base_url('assets/images/lensesAndTintsImage/'.$lenss['image'])?>">
                                            </td>
                                            <td>
                                                <?=$lenss['lensandtint_cat_name']?>
                                            </td>
                                            <td>
                                                <?=$lenss['price']?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" id="<?=$lenss['id']?>" class="change-status" data-table="lenses_and_tints_details" data-url="admin/change-status" title="Status | Green:Active, Red:InActive">
                                                    <?php if($lenss['status'] == 1){ ?>
                                                    <span class="glyphicon glyphicon-ok-sign green-check-icon"></span>
                                                    <?php } else { ?>
                                                    <span class="glyphicon glyphicon-remove-sign red-check-icon"></span>
                                                    <?php } ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?=base_url('admin/edit-lenses-and-tints-details/'.$lenss['id'])?>">
                                                    <i class="fa fa-edit" aria-hidden="false"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } }else{ ?>
                                        <tr style="height:50px; text-align: center; font-weight: bolder;">
                                            <td colspan="6">No Lenses & Tints Sub Category Found !!!</td>
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
