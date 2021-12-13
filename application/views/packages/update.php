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
        <h1 class="m-0">All Packages</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">All Packages</li>
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
                
                <form action="<?php echo base_url('packages/process_update'); ?>" class="form-horizontal" id="add_package_form" method="post">

			<input type="hidden" name="package_id" value="<?php echo (set_value('package_id')) ? set_value('package_id') : (isset($data['package_id']) ? $data['package_id'] : ''); ?>" >

			<div class="form-body">
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Package Name:</label>
						<input type="text" name="package_name" value="<?php echo (set_value('package_name')) ? set_value('package_name') : (isset($data['package_name']) ? $data['package_name'] : ''); ?>" class="form-control" placeholder="Enter Package Name">
						<?php echo form_error('package_name'); ?>
					</div>
        </div>
        <div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Minimum Amount:</label>
						<input type="number" name="package_min_amount" value="<?php echo (set_value('package_min_amount')) ? set_value('package_min_amount') : (isset($data['package_min_amount']) ? $data['package_min_amount'] : ''); ?>" class="form-control" placeholder="Enter Minimum Package Amount">
						<?php echo form_error('package_min_amount'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Maximum Amount:</label>
						<input type="number" name="package_max_amount" value="<?php echo (set_value('package_max_amount')) ? set_value('package_max_amount') : (isset($data['package_max_amount']) ? $data['package_max_amount'] : ''); ?>" class="form-control" placeholder="Enter Maximum Package Amount ">
						<?php echo form_error('package_max_amount'); ?>
					</div>
        </div>
        <div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Package Fees:</label>
						<input type="number" name="package_fees" value="<?php echo (set_value('package_fees')) ? set_value('package_fees') : (isset($data['package_fees']) ? $data['package_fees'] : ''); ?>" class="form-control" placeholder="Enter Package Fees">
						<?php echo form_error('package_fees'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Package Roi:</label>
						<input type="text" name="package_roi" value="<?php echo (set_value('package_roi')) ? set_value('package_roi') : (isset($data['package_roi']) ? $data['package_roi'] : ''); ?>" class="form-control" placeholder="Enter Package Roi">
						<?php echo form_error('package_roi'); ?>
					</div>
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <label class="control-label">Capping:</label>
            <input type="number" name="capping" value="<?php echo (set_value('capping')) ? set_value('capping') : (isset($data['capping']) ? $data['capping'] : ''); ?>" class="form-control" placeholder="Enter Capping">
            <?php echo form_error('capping'); ?>
          </div>
					<!-- <div class="col-md-6">
						<label class="control-label">Package Colour:</label>
						<input type="color" name="package_color" value="<?php echo (set_value('package_color')) ? set_value('package_color') : (isset($data['package_color']) ? $data['package_color'] : ''); ?>" class="form-control" placeholder="Package Colour">
						<?php echo form_error('package_color'); ?>
					</div> -->
				</div>
				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Update Package" class="btn btn-primary">
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
