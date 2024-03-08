
<div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary listtitle">User Role Lists</h6> 
<a href="User_role/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm btn-right "><i class="fas fa-plus fa-sm text-white-50"></i> Add New</a>                        
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="example" width="100%" cellspacing="0">
<thead>
    <tr>
        <th>#</th>
        <th>Role</th>
        <th>E/D Allow</th>
        <th>Template</th>
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
        <td><?=$list->role?></td>
        <td><?=$list->edallow?></td>
        <td><?=$list->template?></td>
        <td><?=$list->created_at?></td>

        <td>
            <?php echo anchor("User_role/edit/".$list->id,"<i class='fa fa-edit label label-primary' ></i>");?> / 
            <?php echo anchor("User_role/delete/".$list->id,"<i class='fa fa-trash label label-primary' ></i>",'onclick="return confirm(\'Are u sure Delete?\');"');?>
            
          

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
