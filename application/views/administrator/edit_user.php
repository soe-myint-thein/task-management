
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Edit Users</h2>
                    <h3><?=$message?></h3>
                </div>
               
            </div>
        </div>
        
        <form action='<?php echo site_url("Users/update/$list->id")?>' method="POST" enctype="multipart/form-data">
       <input type="hidden" name="old_image" value="<?=$list->photo?>">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" value="<?=set_value('name',$list->name)?>" class="form-control" placeholder="Name" required>
                        
                    </div>
                </div>

               
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="email" name="email" value="<?=set_value('email',$list->email)?>" class="form-control" placeholder="Email">
                        
                    </div>
                </div>

                 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Type:</strong>
                        <input type="text" name="user_type" value="<?=set_value('user_type',$list->user_type)?>" class="form-control" placeholder="">
                        
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Role:</strong>
    <?=form_dropdown("user_role",$roles,set_value('user_role',$list->user_role),"class='form-control' required")?>
                        
                    </div>
                </div>
                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Photo:</strong>
                        <input type="file" name="photo" value="<?=set_value('photo',$list->photo)?>" class="form-control" placeholder="Photo">
                        
                    </div>
                    
                     <div class="form-group">
                         <img src="uploads/user/<?=$list->photo?>" width="150"/>
                     </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
