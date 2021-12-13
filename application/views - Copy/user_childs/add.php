
<style type="text/css">
	#add_user_form p{
		color: red;
	}
	.form-body{
		width: 80%;
		margin: 0 auto;
	}
	.page-content{
	    min-height:590px !important;
	}
</style>

<div class="portlet light bordered shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer font-red-sunglo"></i>
			<span class="caption-subject font-red-sunglo bold uppercase">Add User</span>
		</div>

	</div>
	<div class="portlet-body form">
		<?php if($this->session->flashdata("msg")){ ?>
		<div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("msg"); ?></span>
        </div>
    <?php } ?>
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url('user_childs/process_add'); ?>" class="form-horizontal" id="add_user_form" method="post" novalidate>
			<div class="form-body">
				<div class="form-group">
					<div class="col-md-6">
					<label>Full Name:</label>
						<input class="form-control placeholder-no-fix" value="<?php echo set_value('fullname'); ?>" type="text" placeholder="Full Name" name="fullname" required />
 		                <?php echo form_error('fullname');?> 
					</div>
					<div class="col-md-6">
						<label class="control-label">Username:</label>
						<input class="form-control placeholder-no-fix" value="<?php echo set_value('username');?>" type="text" autocomplete="off" placeholder="Username" name="username"  required /> 
 				        <?php echo form_error('username');?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
					<label class="control-label">Email:</label>
						<input class="form-control placeholder-no-fix" value="<?php echo set_value('email');?>" type="text" placeholder="Email" name="email"  required /> 
 			            <?php echo form_error('email');?>
					</div>
				</div>
					<div class="form-group">
							<div class="col-md-6">
					<label class="control-label">Password:</label>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"  required /> 
 					<?php echo form_error('password');?>
					</div>
					<div class="col-md-6">
					    <label class="control-label">Re-type Your Password:</label>
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="cpassword"  required /> 
 						<?php echo form_error('cpassword');?>
					</div>
				</div>

				<div class="form-group" style="margin-bottom: 10px !important;">
					<div class="col-md-3">
						<label class="control-label">Gender:</label>
						<div class="mt-radio-inline">
							<label class="mt-radio" style="margin-bottom: 0px !important;">
								<input type="radio" value="Male" name="gender" required > Male
								<span></span>
							</label>
							<label class="mt-radio" style="margin-bottom: 0px !important;">
								<input type="radio" value="Female" name="gender" required > Female
								<span></span>
							</label>
						</div>
						<?php echo form_error('gender');?>
				    </div>
				    <div class="col-md-3">
							<label class="control-label">Position:</label>
						<div class="mt-radio-inline">
							<label class="mt-radio">
								<input type="radio" name="position" id="optionsRadios25" required value="right" checked="checked"> Right
								<span></span>
							</label>
							<label class="mt-radio">
								<input type="radio" name="position" id="optionsRadios26" required value="left"> Left
								<span></span>
							</label>
						</div>
						<?php echo form_error('position');?>
				    </div>
				</div>

				<!-- <div class="form-group">
					<label class="col-md-3 control-label">Wallet:</label>
					<div class="col-md-4">
						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"  required /> 
 					<?php echo form_error('password');?>
					</div>
				</div> -->

				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Add User" class="btn btn-primary">
					</div>
				</div>

			</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>