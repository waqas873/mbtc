
<style type="text/css">
	#change_password_form p{
		color: red;
	}
	.form-body{
		width: 80%;
		margin: 0 auto;
	}
</style>

<div class="portlet light bordered shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer font-red-sunglo"></i>
			<span class="caption-subject font-red-sunglo bold uppercase">Change Password</span>
		</div>

	</div>
	<div class="portlet-body form">
	
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url('user_childs/process_change_password'); ?>" class="form-horizontal" id="change_password_form" method="post" novalidate>
			<div class="form-body">

				<?php if($this->session->flashdata("success_message")){ ?>
					<div class="alert alert-success shadow">
			            <button class="close" data-close="alert"></button>
			            <strong>Success! </strong><span><?php echo $this->session->flashdata("success_message"); ?></span>
			        </div>
			    <?php } ?>
			    <?php if($this->session->flashdata("error_message")){ ?>
					<div class="alert alert-danger shadow">
			            <button class="close" data-close="alert"></button>
			            <strong>Warning! </strong><span><?php echo $this->session->flashdata("error_message"); ?></span>
			        </div>
			    <?php } ?>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Old Password:</label>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="old_password" placeholder="Old Password" name="old_password"  required /> 
 					<?php echo form_error('old_password');?>
					</div>
					<div class="col-md-6">
					    <label class="control-label">New Password:</label>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="new_password" placeholder="New Password" name="new_password"  required /> 
 					<?php echo form_error('new_password');?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Re-type Your Password:</label>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="cpassword"  required /> 
 						<?php echo form_error('cpassword');?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Change Password" class="btn btn-primary">
					</div>
				</div>

			</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>