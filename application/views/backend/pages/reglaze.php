<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="section-subtitle"><b>REGLAZE</b></h4>
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
                                            <th>Frame Type</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($reglaze)){ 
                                         foreach($reglaze as $rglz){
                                        ?>
                                        <tr style="height: 60px;">
                                            <td>
                                                <?=$rglz['frame_name']?>
                                            </td>
                                            <td style="background-color: #c5c5c4;">
                                                <img src="<?=base_url('assets/images/reglazeImage/'.$rglz['image'])?>">
                                            </td>
                                            <td>
                                                <?=$rglz['price']?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" id="<?=$rglz['id']?>" class="change-status" data-table="reglaze" data-url="admin/change-status" title="Status | Green:Active, Red:InActive">
                                                    <?php if($rglz['status'] == 1){ ?>
                                                    <span class="glyphicon glyphicon-ok-sign green-check-icon"></span>
                                                    <?php } else { ?>
                                                    <span class="glyphicon glyphicon-remove-sign red-check-icon"></span>
                                                    <?php } ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?=base_url('admin/edit-reglaze/'.$rglz['id'])?>">
                                                    <i class="fa fa-edit" aria-hidden="false"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } }else{ ?>
                                        <tr style="height:50px; text-align: center; font-weight: bolder;">
                                            <td colspan="5">No Reglaze Found !!!</td>
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
