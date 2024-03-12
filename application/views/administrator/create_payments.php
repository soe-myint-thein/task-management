
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Payment</h2>
                    <h3><?=$message?></h3>
                </div>
               
            </div>
        </div>
        
        <form action="<?php echo site_url('Payments/store')?>" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Task Name:</strong>
                    <?php echo form_dropdown("task_id",$task_names,'',' class="form-control" '); ?>

                        <span class="text-danger"><?php echo form_error('task_name'); ?></span>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Amount:</strong>
                <input type="number" name="amount" value="<?=set_value('amount')?>" class="form-control" placeholder="Amount" required>

                        
                    </div>
                </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Payment Ref:</strong>
                        <input type="text" name="payment_ref" value="<?=set_value('payment_ref')?>" class="form-control" placeholder="Payment Ref" required>
                        <span class="text-danger"><?php echo form_error('payment_ref'); ?></span>
                    </div>
                </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Payment Type:</strong>
                    <?php echo form_dropdown("payment_type",$payment_types,"",' class="form-control" '); ?>
                        
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
