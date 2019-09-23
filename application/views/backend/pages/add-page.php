<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b>EDIT PAGE DETAILS</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/page-management')?>">
                            <input type="hidden" name="page_slug" value="<?=$page['slug']?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <textarea class="form-control ckeditor" name="description" required aria-required="true"><?=$page['description']?></textarea>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" value="UPDATE DETAILS">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
