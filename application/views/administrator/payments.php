
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary listtitle">Payment Lists</h6> 
 <?php echo anchor("Payments/create",' <i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>','class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btn-right "');?> 

</div>

<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="example" width="100%" cellspacing="0">
<thead>
    <tr>
        <th>#</th>
        <th>Task Name</th>
        <th>amount</th>
        <th>Tpayment_ref</th>
        <th>Payment Type</th>
        <th>Date</th>
       <th>Action</th>
    </tr>
</thead>

<tbody>
    <?php
    $i=1;
    foreach($lists->result() as $list):
    ?>
 <tr>
        <td><?=$i?></td>
        <td><?=$list->task_name?></td>
        <td><?=$list->amount?></td>
        <td><?=$list->payment_ref?></td>
        <td><?=$list->payment_type?></td>
        <td><?=$list->date?></td>
      
        <td>
            <?php echo anchor("Tasks/edit/".$list->id,"<i class='fa fa-edit label label-primary' ></i>");?> / 
            <?php echo anchor("Tasks/delete/".$list->id,"<i class='fa fa-trash label label-primary' ></i>",'onclick="return confirm(\'Are u sure Delete?\');"');?>
            
          

    </td>
    </tr>
  <?php $i++;
  endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>

</div>
