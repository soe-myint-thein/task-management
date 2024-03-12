
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Assign Task</h2>
                    <h3><?=$message?></h3>
                </div>
               
            </div>
        </div>
        
        <form action="<?php echo site_url('Assigned_tasks/store')?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Task Name:</strong>
                    <?php echo form_dropdown("task_id",$task_names,'',' class="form-control" '); ?>
                        <span class="text-danger"><?php echo form_error('task_id'); ?></span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea  name="description" class="form-control" >

                        <?=set_value('description')?>

                         </textarea>
                        
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Task Docs:</strong>
                       <?php echo form_upload("task_docs","",'class="form-control" '); ?>
                     
                        
                    </div>
                </div>


             <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Assign To:</strong>
                          <ul class="noliststyle">
                         <?php
                        //$count=1;
                        foreach($staffs->result() as $list):
                         ?>
                    
                        <li>
                          <input type="checkbox" name="staffs[]" class="option" value="<?=$list->id?>"> 
                          <label for="option"  >  <?=$list->name?></label>
                         
                        </li>
                    
                      
                      <?php
                            
                      //$count++;
                      endforeach;
                      ?>
                        </ul>
                        
                    </div>
                </div>

              

                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Is Supervisor:</strong>
        <?php echo form_radio(array("name"=>"is_supervisor","id"=>"yes","value"=>1, 'checked'=>set_radio('is_supervisor', 1, FALSE))); ?> Yes
        <?php echo form_radio(array("name"=>"is_supervisor","id"=>"no","value"=>0, 'checked'=>set_radio('is_supervisor', 0, TRUE))); ?> No
                        
                    </div>
                </div>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date:</strong>
                        <input type="date" name="date" value="<?=set_value('date')?>" class="form-control" placeholder="date">
                        
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
