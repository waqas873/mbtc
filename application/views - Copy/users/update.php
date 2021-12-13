
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style type="text/css">
	#update_user_form p{
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
			<span class="caption-subject font-red-sunglo bold uppercase">Update Your Account</span>
		</div>

	</div>
	<div class="portlet-body form">
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
		<!-- BEGIN FORM...../////////////////////......-->
		<form enctype="multipart/form-data" action="<?php echo base_url('user_childs/process_update'); ?>" class="form-horizontal" id="update_user_form" method="post" novalidate>
			<div class="form-body">
				<?php if($this->session->userdata("role")=="user") { ?>
				<div class="form-group">
					<div class="col-md-6">
					    <label class="control-label">Full Name:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('fullname')) ? set_value('fullname') : (isset($data['fullname']) ? $data['fullname'] : ''); ?>" type="text" placeholder="Full Name" name="fullname" required />
 		                <?php echo form_error('fullname');?> 
					</div>
					<label class="control-label">Username:<span style="color: #143148;">*</span></label>
					<div class="col-md-6">
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('username')) ? set_value('username') : (isset($data['username']) ? $data['username'] : ''); ?>" type="text" autocomplete="off" placeholder="Username" name="username"  required /> 
 				        <?php echo form_error('username');?>
					</div>
				</div>
                <?php } ?>
                    <div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Email:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('email')) ? set_value('email') : (isset($data['email']) ? $data['email'] : ''); ?>" type="text" placeholder="Email" name="email"  required /> 
 			            <?php echo form_error('email');?>
					</div>
					 <div class="col-md-6">
					    <label class="control-label">Wallet Address:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" type="text" value="<?php echo (set_value('wallet_address')) ? set_value('wallet_address') : (isset($data['wallet_address']) ? $data['wallet_address'] : ''); ?>" autocomplete="off" placeholder="Enter your wallet address" name="wallet_address"  required />
					<?php echo form_error('wallet_address');?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Date of Birth:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" id="datepicker" value="<?php echo (set_value('dob')) ? set_value('dob') : (isset($data['dob']) ? $data['dob'] : ''); ?>" type="text" placeholder="Enter your date of Birth" name="dob"  required /> 
 			            <?php echo form_error('dob');?>
					</div>
					<div class="col-md-6">
						<label class="control-label">Contact No:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('contact_no')) ? set_value('contact_no') : (isset($data['contact_no']) ? $data['contact_no'] : ''); ?>" type="text" placeholder="Please provide your contact number" name="contact_no"  required /> 
 			            <?php echo form_error('contact_no');?>
					</div>
				</div>
                
                <?php if($this->session->userdata("role")=="user") { ?>
				<div class="form-group" style="margin-bottom: 10px !important;">
					<div class="col-md-6">
						<label class="control-label">Select One:<span style="color: #143148;">*</span></label>
						<div class="mt-radio-inline">
							<label class="mt-radio" style="margin-bottom: 0px !important;">
								<input type="radio" class="cpu" value="CNIC" name="cnic_passport_bill" <?php echo (set_value('cnic'))?'checked':((isset($data) && $data['cnic_passport_bill']=="CNIC")?'checked':''); ?>  required > CNIC
								<span></span>
							</label>
							<label class="mt-radio" style="margin-bottom: 0px !important;">
								<input type="radio" class="cpu" value="Passport No" name="cnic_passport_bill" <?php echo (set_value('passport_no'))?'checked':((isset($data) && $data['cnic_passport_bill']=="Passport No")?'checked':''); ?> required > Passport
								<span></span>
							</label>
							<label class="mt-radio" style="margin-bottom: 0px !important;">
								<input type="radio" class="cpu" value="Utility Bill" name="cnic_passport_bill" <?php echo (set_value('utility_bill'))?'checked':((isset($data) && $data['cnic_passport_bill']=="Utility Bill")?'checked':''); ?> required > Utility BIll
								<span></span>
							</label>
							<div style="margin-top: 10px;">
							    <?php echo form_error('cnic_passport_bill');?>	
							</div>
							
							<div id="cnic" style="margin-top: 10px;">
								<input class="form-control placeholder-no-fix" type="number" value="<?php echo (set_value('cnic'))?set_value('cnic'):((isset($data['cnic_passport_bill']) && $data['cnic_passport_bill']=="CNIC")?$data['cpu_value']:''); ?>" autocomplete="off" placeholder="Enter your CNIC number" name="cnic"  required />
							</div>
							<div id="passport_no" style="margin-top: 10px;">
								<input class="form-control placeholder-no-fix" type="text" value="<?php echo (set_value('passport_no'))?set_value('passport_no'):((isset($data['cnic_passport_bill']) && $data['cnic_passport_bill']=="Passport No")?$data['cpu_value']:''); ?>" autocomplete="off" placeholder="Enter your Passport number" name="passport_no"  required />
							</div>
							<div id="utility_bill" style="margin-top: 10px;">
								<input class="form-control placeholder-no-fix" type="text" value="<?php echo (set_value('utility_bill'))?set_value('utility_bill'):((isset($data['cnic_passport_bill']) && $data['cnic_passport_bill']=="Utility Bill")?$data['cpu_value']:''); ?>" autocomplete="off" placeholder="Enter your utility bill number" name="utility_bill"  required />
							</div>
							
						</div>
				    </div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Profile Picture:</label>
						<input class="form-control placeholder-no-fix" type="file" name="profile_pic" />
						<?php if(isset($file_error)) { ?> 
							<div style="color: red;">
								<?php echo $file_error;?>
							</div>
						<?php } ?>
					</div>
				</div>
                <?php } ?>

				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Update Profile" class="btn btn-primary">
					</div>
				</div>

			</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>

<script type="text/javascript">
  $(document).ready(function(){
     
     
     $('#cnic').hide();
     $('#passport_no').hide();
     $('#utility_bill').hide();

     if($('.cpu').is(':checked')){
        var radio_value = $("input[name='cnic_passport_bill']:checked").val();
        if(radio_value=="CNIC"){
            $('#cnic').show();
        }
        if(radio_value=="Passport No"){
            $('#passport_no').show();
        }
        if(radio_value=="Utility Bill"){
            $('#utility_bill').show();
        }
     }

     $(document).on('click','.cpu', function(event) {

          var cnic_passport_bill = $("input[name='cnic_passport_bill']:checked").val();

          if(cnic_passport_bill=="CNIC"){
            $('#passport_no').hide();
            $('#utility_bill').hide();
            $('#cnic').fadeIn();
          }

          if(cnic_passport_bill=="Passport No"){
            $('#cnic').hide();
            $('#utility_bill').hide();
            $('#passport_no').fadeIn();
          }

          if(cnic_passport_bill=="Utility Bill"){
            $('#passport_no').hide();
            $('#cnic').hide();
            $('#utility_bill').fadeIn();
          }
     });

     $("#datepicker").datepicker({ 
     	maxDate: new Date, 
     	minDate: new Date(1960, 6, 12),
     	dateFormat: 'yy-mm-dd' 
     });

  });

</script>