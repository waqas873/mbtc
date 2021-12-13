
<style type="text/css">
	#add_reward_form p{
		color: red;
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
#add_package_form p{
		color: red;
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
            <!-- <div style="margin-bottom: 10px;">
                <a href="<?php echo base_url("packages/add/"); ?>" id="addButton" class="btn btn-info">Add Package</a>
            </div> -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Update Package</h3>
              </div>
              <div class="card-body">
                
                <form enctype="multipart/form-data" action="<?php echo base_url('rewards/process_update'); ?>" class="form-horizontal" id="add_reward_form" method="post">

			<input type="hidden" name="reward_id" value="<?php echo (set_value('reward_id')) ? set_value('reward_id') : (isset($data['reward_id']) ? $data['reward_id'] : ''); ?>">

			<div class="form-body">

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Right Investment:</label>
						<input type="number" name="reward_right_investment" value="<?php echo (set_value('reward_right_investment')) ? set_value('reward_right_investment') : (isset($data['reward_right_investment']) ? $data['reward_right_investment'] : ''); ?>" class="form-control" placeholder="Enter left investment">
						<?php echo form_error('reward_right_investment'); ?>
					</div>
					<div class="col-md-6">
						<label class="control-label">Left Investment:</label>
						<input type="number" name="reward_left_investment" value="<?php echo (set_value('reward_left_investment')) ? set_value('reward_left_investment') : (isset($data['reward_left_investment']) ? $data['reward_left_investment'] : ''); ?>" class="form-control" placeholder="Enter right investment">
						<?php echo form_error('reward_left_investment'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Reward Title:</label>
						<input type="text" name="reward_title" value="<?php echo (set_value('reward_title')) ? set_value('reward_title') : (isset($data['reward_title']) ? $data['reward_title'] : ''); ?>" class="form-control" placeholder="Enter title of reward ">
						<?php echo form_error('reward_title'); ?>
					</div>
					<div class="col-md-6">
						<label class="control-label">Reward Picture:</label>
						<input class="form-control placeholder-no-fix" type="file" name="reward_pic" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Update Reward" class="btn btn-primary">
					</div>
				</div>

			</div>
						</form>
						<!-- END FORM-->

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
