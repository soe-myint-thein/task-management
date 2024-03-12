
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Edit Payment</h2>
                    <h3><?=$message?></h3>
                </div>
               
            </div>
        </div>
        
        <form action='<?php echo site_url("Payments/update/$list->id")?>' method="POST" enctype="multipart/form-data">
            <?=form_hidden("old_files",$list->task_docs)?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Task Name:</strong>
                        <input type="text" name="task_name" value="<?=set_value('task_name',$list->task_name)?>" class="form-control" placeholder="Question" required>
                        <span class="text-danger"><?php echo form_error('task_name'); ?></span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea  name="description" class="form-control" > <?=set_value('description',strip_tags($list->description))?> </textarea>
                        
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
                        <strong>Task Type:</strong>
                    <?php echo form_dropdown("task_type",$task_types,$list->task_type,' class="form-control" '); ?>
                        
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Payment Status:</strong>
                     <?php echo form_dropdown("payment_status",$payment_statuss,$list->payment_status,' class="form-control" '); ?>
              
                        
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Task Status:</strong>
                     <?php echo form_dropdown("task_status",$task_statuss,$list->task_status,' class="form-control" '); ?>
                        
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date:</strong>
                        <?php 
                        $date = new DateTime($list->date);
                        $datum = $date->format('Y-m-d');
                      ?>
                        <input type="date" name="date" value="<?php echo $datum?>" class="form-control" placeholder="date">
                        
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
