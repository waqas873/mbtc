<style type="text/css">
	#update_limit_form p{
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
        <h1 class="m-0">Withdraws</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">Withdraws</li>
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
                <h3 class="card-title">Set Withdraw Limits</h3>
              </div>
              <div class="card-body">
                
                <form action="<?php echo base_url('withdraws/process_withdraw_limits'); ?>" class="form-horizontal" id="update_limit_form" method="post" novalidate>

			<input value="<?php echo (set_value('wl_id')) ? set_value('wl_id') : (isset($data['wl_id']) ? $data['wl_id'] : ''); ?>" type="hidden" name="wl_id" />

			<div class="form-body">
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Minimum Withdraw:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('min_withdraw')) ? set_value('min_withdraw') : (isset($data['min_withdraw']) ? $data['min_withdraw'] : ''); ?>" type="number" placeholder="Enter Minimum Withdraw" name="min_withdraw" required />
 		                <?php echo form_error('min_withdraw');?> 
					</div>
					<div class="col-md-6">
						<label class="control-label">Maximum Withdraw:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('max_withdraw')) ? set_value('max_withdraw') : (isset($data['max_withdraw']) ? $data['max_withdraw'] : ''); ?>" type="number" autocomplete="off" placeholder="Enter Maximum Withdraw" name="max_withdraw"  required /> 
 				        <?php echo form_error('max_withdraw');?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Update Limits" class="btn btn-primary">
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

<script type="text/javascript">
$(document).ready(function(){
    $('#datatable').DataTable({});
});
</script>
