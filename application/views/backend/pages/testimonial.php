<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="section-subtitle"><b>TESTIMONIAL</b></h4>
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
                                            <th>Name</th>
                                            <th>City</th>
                                            <th>Thanksgiving</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($testimonials)){ 
                                         foreach($testimonials as $testimonial){
                                        ?>
                                        <tr style="height: 60px;">
                                            <td>
                                                <?=$testimonial->name?>
                                            </td>
                                            <td>
                                                <?=$testimonial->city?>
                                            </td>
                                            <td>
                                                <?=$testimonial->for_spectogo?>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" id="<?=$testimonial->id?>" class="change-status" data-table="testimonial" data-url="admin/change-status" title="Status | Green:Active, Red:InActive">
                                                    <?php if($testimonial->status == 1){ ?>
                                                    <span class="glyphicon glyphicon-ok-sign green-check-icon"></span>
                                                    <?php } else { ?>
                                                    <span class="glyphicon glyphicon-remove-sign red-check-icon"></span>
                                                    <?php } ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?=base_url('admin/edit-testimonial/'.$testimonial->id)?>">
                                                    <i class="fa fa-edit" aria-hidden="false"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } }else{ ?>
                                        <tr style="height:50px; text-align: center; font-weight: bolder;">
                                            <td colspan="5">No Testimonial Found !!!</td>
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
