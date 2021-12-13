 
<style type="text/css">
	#signup_form p{
      color: red;
	}
	.hint{
		color: #999 !important;
	}
</style>

<div class="content">
	    
	    <?php if ($this->session->flashdata("success_message")) { ?>
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span> <?php echo $this->session->flashdata("success_message"); ?> </span>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata("error_message")) { ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span> <?php echo $this->session->flashdata("error_message"); ?> </span>
            </div>
        <?php } ?>

 <form action="<?php echo base_url('login/process_signup'); ?>" id="signup_form" method="post" novalidate>
 	<h3 class="font-green">Sign Up</h3>
 	<p class="hint"> Enter your personal details below: </p>
 	<div class="form-group">
 		<label class="control-label visible-ie8 visible-ie9">Full Name</label>
 		<input class="form-control placeholder-no-fix" value="<?php echo set_value('fullname'); ?>" type="text" placeholder="Full Name" name="fullname" required />
 		<?php echo form_error('fullname');?> 
 	</div>
 		<div class="form-group">
 			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
 			<label class="control-label visible-ie8 visible-ie9">Email</label>
 			<input class="form-control placeholder-no-fix" value="<?php echo set_value('email');?>" type="text" placeholder="Email" name="email"  required /> 
 			<?php echo form_error('email');?>
 		</div>



 			<p class="hint"> Enter your account details below: </p>
 			<div class="form-group">
 				<label class="control-label visible-ie8 visible-ie9">Username</label>
 				<input class="form-control placeholder-no-fix" value="<?php echo set_value('username');?>" type="text" autocomplete="off" placeholder="Username" name="username"  required /> 
 				<?php echo form_error('username');?>
 			</div>
 				<div class="form-group">
 					<label class="control-label visible-ie8 visible-ie9">Password</label>
 					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"  required /> 
 					<?php echo form_error('password');?>
 				</div>
 					<div class="form-group">
 						<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
 						<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="cpassword"  required /> 
 						<?php echo form_error('cpassword');?>
 					</div>
 					<div class="col-md-9">
						<div class="mt-radio-inline">
							<label class="mt-radio">
								<input type="radio" value="Male" name="gender" required > Male
								<span></span>
							</label>
							<label class="mt-radio">
								<input type="radio" value="Female" name="gender" required > Female
								<span></span>
							</label>

						</div>
						<?php echo form_error('gender');?>
					</div>
					<div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Wallet Address</label>
						<input class="form-control placeholder-no-fix" type="text" value="<?php echo set_value('wallet_address');?>" autocomplete="off" placeholder="Enter your wallet address" name="wallet_address"  required /> 
						<?php echo form_error('wallet_address');?>
					</div>
					<div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Sponsor Id</label>
						<input class="form-control placeholder-no-fix" type="text" value="<?php echo (set_value('sponsor_code'))?set_value('sponsor_code'):(isset($code)?$code:''); ?>" autocomplete="off" placeholder="Sponsorcode" name="sponsor_code"  required /> 
						<?php echo form_error('sponsor_code');?>
					</div>

<div class="form-group">

	<div class="col-md-9">
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
	</div>
</div>
 							<div class="form-group margin-top-20 margin-bottom-20">
 								<label class="mt-checkbox mt-checkbox-outline">
 									<input type="checkbox" name="tnc"  required /> I agree to the
 									<a href="javascript:;">Terms of Service </a> &
 									<a href="javascript:;">Privacy Policy </a>
 									<span></span>
 								</label>
 								<?php echo form_error('tnc');?>
 								<div id="register_tnc_error"> </div>
 							</div>
 							<div class="form-actions">
 								<a href="<?php echo base_url('login/index');?>" class="btn green btn-outline">Back</a>
 								<button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
 							</div>
 						</form>
 					</div>