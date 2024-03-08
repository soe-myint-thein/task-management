   
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Account Setting Form</h2>
                    <h3><?=$message?></h3>
                </div>
               
            </div>
        </div>
        
        <form action="<?php echo site_url('Administrator/change_account_setting')?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Old Password:</strong>
                <input type="password" name="opassword" placeholder="Old Password" class="form-control">
                        <span class="text-danger"><?php echo form_error('opassword'); ?></span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>New Password:</strong>
                <?=form_password('password','','placeholder="New Password" class="form-control"');?>
                        
                    </div>
                       <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>
                
                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Comfirm New Password:</strong>
                <?=form_password('cpassword','','placeholder="Confirm New Password" class="form-control"');?>
                        
                    </div>
                       <span class="text-danger"><?php echo form_error('cpassword'); ?></span>
                </div>
 
               
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
