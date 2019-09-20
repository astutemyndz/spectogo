<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b>ADD BANNER</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/banner-management')?>" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Category Name</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <select class="form-control" name="catName" required>
                                            <option value=""> Select Category </option>
                                            <?php
                                            if(!empty($cat)){
                                                foreach($cat as $catt){
                                            ?>
                                            <option value="<?=$catt->id?>"> <?=$catt->name?> </option>
                                            <?php
                                                }    
                                            }
                                            ?>
                                        </select>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Banner Image</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="file" class="form-control" name="file" aria-required="true" required>
                                        <p>SIZE 1700 X 900</p>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" name="update_home" value="ADD BANNER">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
