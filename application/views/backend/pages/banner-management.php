<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="section-subtitle"><b>BANNERS</b></h4>
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
                                            <th>Image Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($banner)){ 
                                         foreach($banner as $banners){
                                        ?>
                                        <tr style="height: 60px;" class="banner<?=$banners['id']?>">
                                            <td>
                                                <img src="<?=base_url('assets/images/bannerImage/'.$banners['image'])?>" style="height: 300px; width: 500px;">
                                            </td>
                                            <td>
                                                <?=$banners['cat_name']?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" id="<?=$banners['id']?>" class="change-status" data-table="banners" data-url="admin/change-status" title="Status | Green:Active, Red:InActive">
                                                    <?php if($banners['status'] == 1){ ?>
                                                    <span class="glyphicon glyphicon-ok-sign green-check-icon"></span>
                                                    <?php } else { ?>
                                                    <span class="glyphicon glyphicon-remove-sign red-check-icon"></span>
                                                    <?php } ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="delete_banner('<?=$banners['id']?>', '<?=$banners['image']?>')">
                                                    <i class="fa fa-trash" aria-hidden="false"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } }else{ ?>
                                        <tr style="height:50px; text-align: center; font-weight: bolder;">
                                            <td colspan="4">No Banner Found !!!</td>
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
