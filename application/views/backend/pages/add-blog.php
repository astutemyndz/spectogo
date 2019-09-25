<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b><?php if($this->uri->segment(3) != ''){ print 'EDIT'; }else{ print 'ADD'; }?> BLOG</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/blog-management')?>" enctype="multipart/form-data">
                            <input type="hidden" name="blog_id" value="<?php if(isset($blog)){ print $blog[0]['id']; }?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Blog Title</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="blogTitle" value="<?php if(isset($blog)){ print $blog[0]['title'];}?>" required aria-required="true">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Blog Description</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <textarea class="form-control ckeditor" name="blogDesc" required aria-required="true"><?php if(isset($blog)){ print $blog[0]['description'];}?></textarea>
                                    </span>
                                </div>
                            </div>
                            <?php if(isset($blog)){ ?>
                                <div class="form-group">
                                    <label for="lefticon" class="col-sm-2 control-label">Blog Image Selected</label>
                                    <div class="col-sm-10">
                                        <span class="input-with-icon">
                                            <img src="<?=base_url('assets/images/blogImage/'.$blog[0]['image'])?>" style="width: 400px;">
                                            <input type="hidden" name="old_blogImage" value="<?=$blog[0]['image']?>">
                                        </span>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Blog Image</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="file" class="form-control" name="blogImage" <?php if(!isset($blog)){ ?> required aria-required="true" <?php } ?>>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" <?php if($this->uri->segment(3) != '') { ?> value="UPDATE CATEGORY" <?php }else{ ?> value="ADD BLOG" <?php } ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
