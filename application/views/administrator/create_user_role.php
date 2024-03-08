<style type="text/css">
    ul,li {list-style:none;}
</style>
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Create User Role</h2>
                    <h3><?=$message?></h3>
                </div>
               
            </div>
        </div>
        
        <form action='<?php echo site_url("User_role/store")?>' method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="role" value="<?=set_value('role')?>" class="form-control" placeholder="role" required>
                        
                    </div>
                </div>

               
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Edit/Delete Allow ?:</strong>
                       <?=form_dropdown('edallow',array("Yes"=>"Yes","No"=>"No"),"",'class="form-control"');?>
                        
                    </div>
                </div>

                   <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Type:</strong>
                      <?=form_dropdown('template',array("Administrator"=>"Administrator"),"",'class="form-control"');?>
                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                         <?php
                        //$count=1;
                        foreach($permissions->result() as $list):
                         ?>
                      <ul class="subcheck">
                        <li><label>
                          <input type="checkbox" name="permission[]" class="option" value="<?=$list->id?>"> <label for="option"  >  <?=$list->english?></label>
                          <ul>
                              <?php  
                              $submenu=$this->db->get_where("submenu",array('header_menu'=>$list->id));
                              foreach($submenu->result() as $sub):
                            
                            ?>
                            <li><label><input type="checkbox" name="submenu[]" class="subOption" value="<?=$sub->id?>"> <?=$sub->english?></label></li>
                            <?php
                            endforeach;
                            ?>
                        
                          </ul>
                        </li>
                      </ul>
                      
                      <?php
                            
                      //$count++;
                      endforeach;
                      ?>
                        
                    </div>
                </div>
               
                
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
