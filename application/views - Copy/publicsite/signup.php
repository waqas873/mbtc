
	
		<!-- Header --> 
			<header class="site-header header-s1 is-sticky">
			   
			   <?php $this->load->view("publicsite/common_header"); ?>

				<div class="page-head section row-vm light wow lightSpeedIn">
				<div class="imagebg i_c23">
					<img src="publicsite/images/compensation_plan.jpg" alt="page-head">
				</div>
				<div class="container">
					<div class="row text-center i_c24">
						<div class="col-md-12">
							<h2 style="color: #fff;text-shadow: 0px 2px 7px #143148;">SignUp</h2>
							<div class="page-breadcrumb">
								<ul class="breadcrumb">
									<li><a href="<?php echo base_url('publicsite/index');?>" style="color: #fff;text-shadow: 0px 2px 7px #143148;">Home</a></li>
									<li class="active" style="color: #fff;text-shadow: 0px 2px 7px #143148;"><span>Sign Up</span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- #end Navbar -->
		</header>
     	
       	<!-- Section -->


       	<div class="section section-pad i_c22">

       		<?php if ($this->session->flashdata("success_message")) { ?>
	       		<div style="width: 38%; margin: auto;">
		            <div class="alert alert-success">
		                <button class="close" data-close="alert"></button>
		                <span> <?php echo $this->session->flashdata("success_message"); ?> </span>
		            </div>
	            </div>
	        <?php } ?>
	        <?php if ($this->session->flashdata("error_message")) { ?>
	        	<div style="width: 38%; margin: auto;">
		            <div class="alert alert-danger">
		                <button class="close" data-close="alert"></button>
		                <span> <?php echo $this->session->flashdata("error_message"); ?> </span>
		            </div>
	            </div>
	        <?php } ?>



           <style type="text/css">
				#signup_form p{
			      color: #FCFF00;
				}
				.hint{
					color: #999 !important;
				}
				#login_form p{
			      color: #FCFF00;
				}
				.sign_up_size{width:50% !important;}
				@media(max-width: 580px){
				    .sign_up_size{width:100% !important;}
                }
			</style>

			<div class="container">
				<div class="tab-custom">
					<div class="row">
						<div class="col-md-4 col-md-offset-4  col-sm-6 col-sm-offset-3">
							<ul class="nav nav-tabs ucap" id="loginreg-form">
								<li class="<?php echo (isset($signup_tab))?" ":"active"; ?>"><a href="#tab1" data-toggle="tab">Log In</a></li>
								<li class="<?php echo (isset($signup_tab))?"active":""; ?>"><a href="#tab2" data-toggle="tab">Register</a></li>
							</ul>
						</div>
					</div>
					<div class="gaps size-2x"></div>
					<!-- Tab panes -->
					<div class="tab-content no-pd">
						<div class="tab-pane fade <?php echo (isset($signup_tab))?"":"in active"; ?>" id="tab1">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 sign_up_size" style="background-image: url(publicsite/images/masthead.jpg ) ; background-repeat: no-repeat; background-size: cover; opacity: 0.9; padding: 0px;">
									<div class="u_3">
									<h4 class="heading-lead center u_4">Login Your Account</h4>
									<form class="form-signup" action="<?php echo base_url('publicsite/process_login');?>" method="post" id="login_form" novalidate>
										<div class="form-results"></div>
										<div class="form-group">
											<div class="form-field form-m-bttm">
												<label>Email</label>
												<input name="email" type="email" class="form-control required email" aria-required="true">
												<?php echo form_error('email');?>
											</div>
										</div>
										<div class="form-group">
											<div class="form-field">
												<label>Password</label>
												<input name="password" type="password" class="form-control required" aria-required="true">
												<?php echo form_error('password');?>
											</div>
										</div>
										<button type="submit" class="btn btn-alt">Log In</button>
										<span class="gaps"></span>
										<p class="small" style="color: white !important;">Not registered? <a class="switch-tab" data-tabnav="loginreg-form" href="#tab2" data-toggle="tab" style="color: white;">Register here</a></p>
									</form>
								</div>
								</div>
							</div>
						</div><br>
						
						<div class="tab-pane fade <?php echo (isset($signup_tab))?"in active":" "; ?>" id="tab2">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="background-image: url(publicsite/images/can.jpg);padding: 0px; background-size: cover;">
									<div class="u_3">


											<h4 class="heading-lead center u_4">Register An Account</h4>
									    <form class="form-signup" action="<?php echo base_url('publicsite/process_signup'); ?>" id="signup_form" method="post" novalidate>
										<div class="form-results"></div>
										<div class="form-group">
											<div class="form-field form-m-bttm">
												<label>Name</label>
												<input class="form-control placeholder-no-fix" value="<?php echo set_value('fullname'); ?>" type="text" name="fullname" required />
 		                                        <?php echo form_error('fullname');?> 
											</div>
										</div>
										<div class="form-group">
											<div class="form-field form-m-bttm">
												<label>Email</label>
												<input class="form-control placeholder-no-fix" value="<?php echo set_value('email');?>" type="email" name="email"  required /> 
 			                                    <?php echo form_error('email');?>
											</div>
										</div>
										<div class="form-group">
											<div class="form-field form-m-bttm">
												<label>Username</label>
												<input class="form-control placeholder-no-fix" value="<?php echo set_value('username');?>" type="text" name="username"  required /> 
 				                                <?php echo form_error('username');?>
											</div>
										</div>
										<div class="form-group">
											<div class="form-field">
												<label>Password</label>
												<input class="form-control placeholder-no-fix" type="password" autocomplete="off" name="password"  required /> 
 					                            <?php echo form_error('password');?>
											</div>
										</div>
										<div class="form-group">
											<div class="form-field">
												<label>Confirm Password</label>
												<input class="form-control placeholder-no-fix" type="password" autocomplete="off" name="cpassword"  required /> 
 						                        <?php echo form_error('cpassword');?>
											</div>
										</div>
										<div class="form-group">
											<div class="form-field">
												<label>Gender</label>
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
										</div>
										<div class="form-group">
											<div class="form-field">
												<label>Wallet Address</label>
												<input class="form-control placeholder-no-fix" type="text" value="<?php echo set_value('wallet_address');?>" autocomplete="off" name="wallet_address"  required /> 
						                        <?php echo form_error('wallet_address');?>
											</div>
										</div>
										<div class="form-group">
											<div class="form-field">
												<label>Sponsor Id</label>
												<input class="form-control placeholder-no-fix" type="text" value="<?php echo (set_value('sponsor_code'))?set_value('sponsor_code'):(isset($code)?$code:''); ?>" autocomplete="off" name="sponsor_code"  required /> 
						                        <?php echo form_error('sponsor_code');?>
											</div>
										</div>
										<div class="form-group">
											<div class="form-field">
												<label>Position</label>
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
										<div class="form-group">
											<div class="form-field">
												<input type="checkbox"  name="tnc">
												<span style="color: #fff;"> I accept and agree with the terms of the <a href="#" style="color: #fff;">User Agreement</a>.
												</span>
												<?php echo form_error('tnc');?>
											</div>
										</div>

										<button type="submit" class="btn btn-alt">Signup</button>
										<span class="gaps"></span>
										<p class="small" style="color: #fff !important;background: #143148b5;width: 230px !important;padding: 5px;border-radius: 4px;">Already registered? <a class="switch-tab" data-tabnav="loginreg-form" href="#tab1" data-toggle="tab" style="color: #fff;">Login here</a></p>
									</form>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="container">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-8">
									<div class="box" style="border: 1px solid #efb2b2; border-radius: 5px; border-left: 4px solid#e41515; line-height: 1; padding: 10px;     background-image: linear-gradient( rgba(255,0,0,0), rgba(255,0,0,0.2));" >
										<h6 style="color: red;">Attention!</h6>

										<p style="font-size: 0.7em; color: #8c0505!important;">
											
You are entering into a secured website. Any unauthorised access, modification or impairment to the contents of this website is a serious crime and any such action or attempt by you will result in the commencement of legal action and prosecution against you to the fullest extent provided under law. Such legal action shall include criminal prosecution and action for recovery of loss and damage pursuant to any unlawful and/or illegal activities perpetrated.
										</p>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
				</div>
			</div>	
		</div>
		<!-- End Section -->
      	
       	