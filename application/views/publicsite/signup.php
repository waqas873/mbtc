
<link rel="stylesheet" href="assets/tel/build/css/intlTelInput.css">
<!-- <link rel="stylesheet" href="assets/tel/build/css/demo.css"> -->

<style type="text/css">
  .all_errors{
    color: red;
  	position: relative;
  	top: -14px;
  }
  .all_errors p{
    color: red !important;
  }
.subscribe-text {
    border-radius: 6rem;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: 1px solid #194089;
    padding: 1rem 2rem;
    width: 100%;
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 20px !important;
}
.subscribe-btn {
    /*position: absolute;
    right: 25px;
    top: 8px;*/
    height: 2.5rem;
    width: 2.5rem;
    padding-left: 0.75rem;
    float: right;
    margin-top: -67px;
    margin-right: 10px;
}
#signup_form p{
    color: red;
}
/*.mx-auto{
  box-shadow: 0 0 12px 0 #9E48CD;
  background-image: -moz-linear-gradient(50deg, #BF68E6 20%, #9E48CD 51%, #BF68E6 90%);
  opacity: 1;
}*/
.iti{
  width: 100% !important;
  margin: 0px 0px 20px 0px;
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

<!-- Contact -->
<section id="contact" class="contact section-padding bg-color">
    <div class="container-fluid">
        <div class="container">
            <div class="heading text-center">
                <h2 class="title animated" data-animation="fadeInUpShorter" data-animation-delay="0.3s">Create Your Account</h2>
                <div class="separator animated" data-animation="fadeInUpShorter" data-animation-delay="0.3s">
                    <span class="large"></span>
                    <span class="medium"></span>
                    <span class="small"></span>
                </div>
                <p class="content-desc animated" data-animation="fadeInUpShorter" data-animation-delay="0.4s">Signup here to create your account</p>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-8 mx-auto">
                    <form action="<?php echo base_url('publicsite/process_signup'); ?>" method="post" accept-charset="utf-8" class="text-center" id="signup_form">
                      <div>
                        <input type="text" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="fullname" placeholder="Your name" value="<?php echo set_value('fullname'); ?>">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"><!-- <i class="ti-angle-right"></i> --></button>
                      </div>
                      <?php echo form_error('fullname');?>
                      <div>
                        <input type="email" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="email" placeholder="Your Email" value="<?php echo set_value('email'); ?>">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"><!-- <i class="ti-angle-right"></i> --></button>
                      </div>
                      <?php echo form_error('email');?>
                      <div>
                        <input type="text" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="username" placeholder="Your Username" value="<?php echo set_value('username'); ?>">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"><!-- <i class="ti-angle-right"></i> --></button>
                      </div>
                      <?php echo form_error('username');?>
                      <div>
                        <input type="password" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="password" placeholder="Enter your password">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"><!-- <i class="ti-angle-right"></i> --></button>
                      </div>
                      <?php echo form_error('password');?>
                      <div>
                        <input type="password" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="cpassword" placeholder="Enter your confirm password">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"><!-- <i class="ti-angle-right"></i> --></button>
                      </div>
                      <?php echo form_error('cpassword');?>
                      <div style="margin-bottom: 10px;">
                      		<div class="custom-control custom-radio" style="width: 70px;float: left;">
						      <input type="radio" class="custom-control-input" id="customRadio" name="gender" value="Male">
						      <label class="custom-control-label" for="customRadio">Male</label>
						    </div>
                            <div class="custom-control custom-radio" style="width: 80px;margin-left: 80px;">
						      <input type="radio" class="custom-control-input" id="customRadio2" name="gender" value="Female">
						      <label class="custom-control-label" for="customRadio2" style="text-align: left !important;">Female</label>
						    </div>
                      </div>
                      <?php echo form_error('gender');?>
                      <!-- <div>
                        <input type="text" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="wallet_address" placeholder="Your Tether Wallet Address" value="<?php echo set_value('wallet_address'); ?>">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"></button>
                      </div>
                      <?php echo form_error('wallet_address');?> -->
                      <div>
                        <input type="tel" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="contact_no" id="contact_no" value="<?php echo set_value('contact_no'); ?>">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"><!-- <i class="ti-angle-right"></i> --></button>
                      </div>
                      <?php echo form_error('contact_no');?>
                      <!-- <div>
                        <select class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="country">
                          <option value="">Select Country</option>
                          <?php
                          if(!empty($countries)){
                            foreach($countries as $key => $value){
                          ?>
                          <option value="<?php echo $value['country_name'];?>"><?php echo $value['country_name'];?></option>
                          <?php } } ?>
                        </select>
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"></button>
                      </div> -->
                      <?php echo form_error('country');?>

                      <div>
                        <?php
                        $sc = '';
                        if(!empty($sponsor_code)){
                          $sc = $sponsor_code;
                        }
                        if(!empty(set_value('sponsor_code'))){
                          $sc = set_value('sponsor_code');
                        }
                        ?>
                        <input type="text" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="sponsor_code" placeholder="Your Sponsor Id" value="<?php echo $sc; ?>">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"><!-- <i class="ti-angle-right"></i> --></button>
                      </div>
                      <?php echo form_error('sponsor_code');?>
                      <?php
                        $left = '';
                        if(!empty($side) && $side=="left"){
                          $left = "checked";
                        }
                        if(!empty(set_value('position')) && set_value('position')=="left"){
                          $left = "checked";
                        }
                        $right = '';
                        if(!empty($side) && $side=="right"){
                          $right = "checked";
                        }
                        if(!empty(set_value('position')) && set_value('position')=="right"){
                          $right = "checked";
                        }
                      ?>
                      <div style="margin-bottom: 10px;">
                      	<div class="custom-control custom-radio" style="width: 70px;float: left;">
						              <input type="radio" class="custom-control-input" id="customRadio3" name="position" value="right" <?php echo $right; ?> >
						              <label class="custom-control-label" for="customRadio3">Right</label>
						            </div>
                        <div class="custom-control custom-radio" style="width: 80px;margin-left: 80px;">
						              <input type="radio" class="custom-control-input" id="customRadio23" name="position" value="left" <?php echo $left; ?>>
						              <label class="custom-control-label" for="customRadio23" style="text-align: left !important;">Left</label>
						            </div>
                      </div>
                      <?php echo form_error('position');?>
                        <button type="submit" class="btn btn-lg btn-glow btn-gradient-orange btn-round animated" data-animation="fadeInUpShorter" data-animation-delay="1.1s">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Contact -->

<script src="assets/tel/build/js/intlTelInput.js"></script>
<script>
$(document).ready(function(){

  var input = document.querySelector("#contact_no");
  window.intlTelInput(input, {
    allowExtensions: true,
    autoFormat: false,
    autoHideDialCode: false,
    autoPlaceholder: true,
    defaultCountry: "auto",
    ipinfoToken: "yolo",
    nationalMode: false,
    numberType: "MOBILE",
    //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
    //preferredCountries: ['cn', 'jp'],
    preventInvalidNumbers: true,
    utilsScript: "assets/tel/build/js/utils.js",
  });

  // $("#contact_no").change(function(){
  //   var iti = window.intlTelInputGlobals.getInstance(input);
  //   var isValid = iti.isValidNumber();
  //   if(isValid==true){
  //     alert("valid");
  //   }
  //   else{
  //     alert("invalid");
  //   }
  // });

});
    

</script>