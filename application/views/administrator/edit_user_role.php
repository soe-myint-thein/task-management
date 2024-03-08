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
        
        <form action='<?php echo site_url("User_role/update/$list->id")?>' method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="role" value="<?=set_value('role',$list->role)?>" class="form-control" placeholder="role" required>
                        
                    </div>
                </div>

               
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Edit/Delete Allow ?:</strong>
                       <?=form_dropdown('edallow',array("Yes"=>"Yes","No"=>"No"),$list->edallow,'class="form-control"');?>
                        
                    </div>
                </div>

                   <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Type:</strong>
                      <?=form_dropdown('template',array("Admin"=>"Admin","Client"=>"Client","Staff"=>"Staff"),$list->template,'class="form-control"');?>

                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                       <?php

                        $c="";
                        $per=array();
                        foreach($permissions->result() as $plist):

                        $per[$plist->english]=$plist->id;

                        endforeach;

                        $d = $list->permission;
                        $exp = explode(",", $d);

                        $result=array_intersect($per,$exp);

                      ?>

                        <?php
                        //$count=1;
                        foreach($permissions->result() as $plist):
                          if(in_array($plist->id, $result))
                          {
                            $c="checked";
                          }

                          else
                          {
                            $c="";
                          }
                         ?>
                        
                        
                          
                        <ul class="subcheck">
                        <li><label>
                          <input type="checkbox" name="permission[]" class="option" value="<?=$plist->id?>" <?=$c?>>
                          <label for="option">  <?=$plist->english?></label>
                          <ul>
                              <?php  
                              $submenu=$this->db->get_where("submenu",array('header_menu'=>$plist->id));
                              foreach($submenu->result() as $sub):
                                  
                                    $sb="";
                                    $pers=array();
                                    
                                    $pers[$sub->english]=$sub->id;

            
                                    $ds = $list->submenu;
                                    $exps = explode(",", $ds);
            
                                    $subres=array_intersect($pers,$exps);
                                  
                                  if(in_array($sub->id, $subres))
                                  {
                                    $sb="checked";
                                  }
        
                                  else
                                  {
                                    $sb="";
                                  }
                                  
                                  
                            
                            ?>
                            <li><label><input type="checkbox" name="submenu[]" class="subOption" value="<?=$sub->id?>" <?=$sb?>> <?=$sub->english?></label></li>
                            <?php
                            endforeach;
                            ?>
                        
                          </ul>
                        </li>
                      </ul>
                      
                      <?php
                      endforeach;
                      ?>
                        
                    </div>
                </div>
               
                
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
