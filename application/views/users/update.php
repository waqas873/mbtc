<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
	#update_user_form p{
		color: red;
	}
	/*.form-body{
		width: 80%;
		margin: 0 auto;
	}*/
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
        <h1 class="m-0">My Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">My Profile</li>
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
                <h3 class="card-title">My Profile Page</h3>
              </div>
              <div class="card-body">
                
            <form enctype="multipart/form-data" action="<?php echo base_url('user_childs/process_update'); ?>" class="form-horizontal" id="update_user_form" method="post" novalidate>
			<div class="form-body">
				<?php if($this->session->userdata("role")=="user") { ?>
				<div class="form-group">
					<div class="col-md-6">
					    <label class="control-label">Full Name:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('fullname')) ? set_value('fullname') : (isset($data['fullname']) ? $data['fullname'] : ''); ?>" type="text" placeholder="Full Name" name="fullname" required />
 		                <?php echo form_error('fullname');?> 
					</div>
				</div>
        <?php } ?>
        <div class="form-group">
          <div class="col-md-6">
              <label class="control-label">Username:<span style="color: #143148;">*</span></label>
            <input class="form-control placeholder-no-fix" value="<?php echo (set_value('username')) ? set_value('username') : (isset($data['username']) ? $data['username'] : ''); ?>" type="text" autocomplete="off" placeholder="Username" name="username"  required /> 
                <?php echo form_error('username');?>
          </div>
        </div>
                <div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Email:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('email')) ? set_value('email') : (isset($data['email']) ? $data['email'] : ''); ?>" type="text" placeholder="Email" name="email"  required /> 
 			            <?php echo form_error('email');?>
					</div>
				</div>
				<div class="form-group">
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
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Contact No:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('contact_no')) ? set_value('contact_no') : (isset($data['contact_no']) ? $data['contact_no'] : ''); ?>" type="text" placeholder="Please provide your contact number" name="contact_no"  required /> 
 			            <?php echo form_error('contact_no');?>
					</div>
				</div>
                
                <?php if($this->session->userdata("role")=="user") { ?>
				<!-- <div class="form-group" style="margin-bottom: 10px !important;">
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
				</div> -->
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
        <?php if($this->session->userdata("role")=="user") { ?>
        <div class="form-group">
          <div class="col-md-6">
              <label class="control-label">My ID:<span style="color: #143148;">*</span></label>
            <input class="form-control placeholder-no-fix" value="<?php echo (set_value('sponsor_code')) ? set_value('sponsor_code') : (isset($data['sponsor_code']) ? $data['sponsor_code'] : ''); ?>" type="text" placeholder="Full Name" name="sponsor_code" required />
            <?php echo form_error('sponsor_code');?> 
          </div>
        </div>
        <?php } ?>

				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Update Profile" class="btn btn-primary yellow-btns" id="updateProfileBtn">
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

<div class="modal fade" id="otpModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">OTP For Profile Update</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="otpForm">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="first_name">An OTP is sent to your email address.Please check your mail and enter otp for profile update.</label>
                <input type="text" name="otp" class="form-control" placeholder="Enter otp" required>
                <div class="all_errors otp_error"></div>
              </div>
            </div>
            <button type="submit" class="btn btn-info yellow-btns">Send</button>
          </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

$(document).on('click', '#updateProfileBtn', function (e) {
  e.preventDefault();
  $.LoadingOverlay("show");
  $.ajax({
    url: base_url+'/otp/send_otp/profile',
    type: 'GET',
    dataType: 'JSON',
    success: function (data) {
      if(data.proceed){
        $('#update_user_form').submit();
      }
      else if(data.otp){
        $("#otpModal").modal();
      }
    },
    complete: function(){
      $.LoadingOverlay("hide");
    }
  });
});

$(document).on('submit', '#otpForm', function(e){
  e.preventDefault();
  var obj = $(this);
  $('.all_errors').empty();
  var formData = obj.serializeArray();
  $.LoadingOverlay("show");
  $.ajax({
      url: base_url+'/otp/verify_otp',
      type: 'POST',
      data: formData,
      dataType: 'JSON',
      success: function (data) {
        if(data.response){
          $("#otpModal").modal("hide");
          $('#update_user_form').submit();
        }
        else{
          swal({
            title: "Warning!",
            text: "Please enter valid OTP.",
            icon: "error",
            button: "OK",
          });
        }
      },
      complete: function(){
        $.LoadingOverlay("hide");
      }
  });
});

$('#datatable').DataTable({});

$("#datepicker").datepicker({ 
	maxDate: new Date, 
	minDate: new Date(1960, 6, 12),
	dateFormat: 'yy-mm-dd' 
});

});
</script>