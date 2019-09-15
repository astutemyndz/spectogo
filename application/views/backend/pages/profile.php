<div class="content">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="section-subtitle"><b>PROFILE</b></h4>
                        <form class="form-horizontal" method="post" action="<?=base_url('admin/profile')?>">
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Full Name</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control restrictSpecial" name="name" value="<?=$adminDetails[0]->name?>" required="" aria-required="true" onkeypress="return isChar(this.event)">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="email" class="form-control" name="email" value="<?=$adminDetails[0]->email?>" required aria-required="true">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="text" class="form-control" name="phone" value="<?=$adminDetails[0]->phone?>" onkeypress="return isNumber(this.event)">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lefticon" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <span class="input-with-icon">
                                        <input type="password" class="form-control" name="password" aria-required="true">
                                        <i class="fa fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="submit" class="btn btn-danger" name="update_pro" value="UPDATE">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
