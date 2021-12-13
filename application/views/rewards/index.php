
<style type="text/css">
	.caption_color{
		color: #fff !important;
	}
	.text_center{
		text-align: center;
	}
	.border_radius{
		border-radius: 5px !important;
	}
    .error{
        color: red;
    }
    .plb {
    background-color: white !important;
}
</style>

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
        <div class="col-sm-12">
            <div style="margin-bottom: 10px;">
                <a href="<?php echo base_url("rewards/add/"); ?>" id="addButton" class="btn btn-info">Add Reward</a>
            </div>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">All Rewards List</h3>
              </div>
              <div class="card-body">
                
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Reward Title</th>
                    <th>Right Investment</th>
                    <th>Left Investment</th>
                    <th>Image</th>
                    <th>Date</th>
                    <!-- <th>Reward To</th> -->
                    <th>Actions</th>
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
  <td class="text_center"><?php echo "$".$reward['reward_right_investment']; ?></td>
  <td class="text_center"><?php echo "$".$reward['reward_left_investment']; ?></td>
  <td class="text_center">
    <?php if(!empty($reward['reward_pic'])) { ?>
    <a target="_blank" style="text-decoration: none;" href="<?php echo base_url('assets/reward_images/'.$reward['reward_pic']);?>">Image</a>
    <?php } else { ?>
    <a href="javascript::" style="text-decoration: none;">Not Availble</a>
    <?php } ?>
  </td>
  <td class="text_center">
                          <?php 
                              $datetime = explode(' ', $reward['reward_date']);
                              $date = $datetime[0];
                              echo $date; 
                          ?>                              
                      <!-- </td>
  <td class="text_center">
    <a href="javascript::" rel="<?php echo $reward['reward_id']; ?>" id="reward_to" class="btn btn-success btn-sm border_radius">Reward To</a>
  </td> -->
                      <td class="text_center">
                          <div style="width: 145px;margin: auto;">
                              <a href="<?php echo base_url('rewards/update/'.$reward['reward_id']);?>" class="btn btn-success btn-sm border_radius">Edit</a>
                              <a href="<?php echo base_url('rewards/delete/'.$reward['reward_id']);?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'rewards'); return false;">Delete</a>
                          </div>
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

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 30px !important;margin-top: 167px;">
      <div class="modal-header">
        <h4 class="modal-title">Reward To</h4>
      </div>
      <div class="modal-body">
        <div class="portlet box green" >
          <div class="portlet-title">
            <div class="caption">
               Provide Email
            </div>
          </div>
          <div class="portlet-body">
              <span style="font-size: 16px; color: green;">
                Please enter user email for this reward. 
              </span>
              <div class="row">
                <form method="post" action="<?php echo base_url('user_rewards/process_add'); ?>" id="reward_form" novalidate>
                 <div class="row">
                  <div class="col-lg-9" style="margin-top: 11px;margin-left: 13px;">
                    <div class="form-group">
                      <input type="hidden" name="reward_id" id="reward_id">
                      <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter user email here" required >
                      <span id="package_error" style="color: red;"></span>
                    </div>
                  </div>
                  <div class="col-lg-2">
                   <div class="form-group">
                    <input type="submit" class="btn btn-info" style="height: 36px !important;margin-top: 11px;padding: px 27px 0px 23px !important;" value="Submit">
                   </div>
                 </div>

               </div>
             </form>
           </div>
       </div>
     </div>

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>

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

<script type="text/javascript">
$(document).ready(function(){

    $(document).on("click","#reward_to",function(){
        var reward_id = $(this).attr('rel');
        $('#reward_id').val('');
        if(reward_id != ''){
            $('#reward_id').val(reward_id);
            $("#myModal").modal();
        }
    });

    $('#reward_form').validate();

    $(document).on("submit","#reward_form",function(){
        if($('#reward_form').valid()){
            $("#myModal").modal('hide');
        }
    });

});
</script>
