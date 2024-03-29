
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Task</h2>
                    <h3><?=$message?></h3>
                </div>
               
            </div>
        </div>
        
        <form action="<?php echo site_url('Tasks/store')?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Task Name:</strong>
                        <input type="text" name="task_name" value="<?=set_value('task_name')?>" class="form-control" placeholder="Question" required>
                        <span class="text-danger"><?php echo form_error('question'); ?></span>
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
                        <strong>Date:</strong>
                        <input type="date" name="date" value="<?=set_value('date')?>" class="form-control" placeholder="date">
                        
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
