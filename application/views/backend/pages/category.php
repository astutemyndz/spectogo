<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="section-subtitle"><b>CATEGORY</b></h4>
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
                                <table id="responsive-table" class="table table-striped table-hover responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($cat)){ 
                                         foreach($cat as $catt){
                                        ?>
                                        <tr style="height: 60px;">
                                            <td>
                                                <?=$catt->name?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" id="<?=$catt->id?>" class="change-status" data-table="categories" data-url="admin/change-status" title="Status | Green:Active, Red:InActive">
                                                    <?php if($catt->status == 1){ ?>
                                                    <span class="glyphicon glyphicon-ok-sign green-check-icon"></span>
                                                    <?php } else { ?>
                                                    <span class="glyphicon glyphicon-remove-sign red-check-icon"></span>
                                                    <?php } ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?=base_url('admin/edit-category/'.$catt->id)?>">
                                                    <i class="fa fa-edit" aria-hidden="false"></i>
                                                    <!--<i class="fa fa-trash" aria-hidden="false"></i>-->
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } }else{ ?>
                                        <tr style="height:50px; text-align: center; font-weight: bolder;">
                                            <td colspan="3">No Category Found !!!</td>
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
