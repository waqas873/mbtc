<style type="text/css">
.all_errors{
  color: #FF934A;
}
.all_inputs{
  width: 100%;
}
.modal-dialog {
    max-width: 60% !important;
}
</style>

<?php if($this->session->flashdata('success_message')) { ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
        title: "Success!",
        text: "<?php echo $this->session->flashdata('success_message'); ?>",
        icon: "success",
        button: "OK",
      });
    });
  </script>
<?php } ?>
<?php if($this->session->flashdata('error_message')) { ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
        title: "Warning!",
        text: "<?php echo $this->session->flashdata('error_message'); ?>",
        icon: "error",
        button: "OK",
      });
    });
  </script>
<?php } ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">All Rewards</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">All Rewards</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <!-- /.col (left) -->
        <div class="col-sm-12" style="margin-bottom: 10px;">
            <!-- <div>
                <a href="javascript::" id="addButton" class="btn btn-info">Add User</a>
            </div> -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">All Rewards List</h3>
              </div>
              <div class="card-body">
                
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                   <th>Sr No</th>
                   <th>Title</th>
                   <th>Right Investment</th>
                   <th>Left Investment</th>
                   <th>My Right Investment</th>
                   <th>My Left Investment</th>
                   <th>Image</th>
                   <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php 
                if(isset($rewards) && !empty($rewards)) { 
                  $index = 1;
                  foreach ($rewards as $reward) {
                    ?>
                    <tr class="table_text_shadow">
                       <td class="text_center"><?php echo $index; ?></td>
                       <td class="text_center"><?php echo $reward['reward_title']; ?></td>
                       <td class="text_center">$<?php echo $reward['reward_right_investment']; ?></td>
                       <td class="text_center">$<?php echo $reward['reward_left_investment']; ?></td>
                       <td class="text_center">$<?php echo $reward['user_right_investment']; ?></td>
                       <td class="text_center">$<?php echo $reward['user_left_investment']; ?></td>
                       <td class="text_center">
                          <?php if(!empty($reward['reward_pic'])) { ?>
                          <img src="<?php echo base_url('assets/reward_images/'.$reward['reward_pic']);?>" width="50" height="50" style="border-radius: 50% !important;">
                          <?php } else { ?>
                          <a href="javascript::" style="text-decoration: none;">Not Availble</a>
                          <?php } ?>
                        </td>
                       <td class="text_center">
                        <?php 
                          $status = $reward['status'];
                          if($reward['status']==1){
                            $status = '<i class="fa fa-check icon_style" data-toggle="tooltip" title="You are qualified for this reward!" aria-hidden="true"></i>';
                          }
                          if($reward['status']==2){
                            $status = '<span data-toggle="tooltip" title="Congrats! You have been awarded with this reward."><i class="fa fa-check icon_style" aria-hidden="true"></i><i class="fa fa-check icon_style" aria-hidden="true"></i></span>';
                          }
                          echo $status;
                        ?>
                       </td>
                    </tr>
                <?php 
                $index++; 
              } 
            } 
            ?>
          </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col (right) -->
    </div>
  </div><!--/. container-fluid -->
</section>
<!-- /.content -->

<!-- <div class="modal fade" id="addModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add <?php echo $this->title;?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="addForm">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" class="form-control first_name" placeholder="First Name">
                  <div class="all_errors first_name_error"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" class="form-control last_name" placeholder="Last Name">
                  <div class="all_errors last_name_error"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control email" placeholder="First Name">
                  <div class="all_errors email_error"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="status">Status</label>
                  <select class="form-control status select2" name="status">
                      <option value="1">Active</option>
                      <option value="2">Inactive</option>
                  </select>
                </div>
              </div>
              <button type="submit" class="btn btn-info">Save Data</button>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div> -->

<script type="text/javascript">
$(document).ready(function(){
    $('#datatable').DataTable({});
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
