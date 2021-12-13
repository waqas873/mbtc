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

<!-- <section class="head-area">
    <div id="particles-js-2"></div>
    <div class="head-content container-fluid bg-gradient d-flex align-items-center">
    </div>
</section> -->

<!-- Contact -->
<section id="contact" class="contact section-padding bg-color">
    <div class="container-fluid">
        <div class="container">
            <div class="heading text-center">
                <h2 class="title animated" data-animation="fadeInUpShorter" data-animation-delay="0.3s">Enter Your Username</h2>
                <div class="separator animated" data-animation="fadeInUpShorter" data-animation-delay="0.3s">
                    <span class="large"></span>
                    <span class="medium"></span>
                    <span class="small"></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-8 mx-auto">
                    <form class="text-center" id="forgotPasswordForm">
                      <div>
                        <input type="text" class="form-control animated subscribe-text" data-animation="fadeInUpShorter" data-animation-delay="0.8s" name="username" placeholder="Your username">
                        <button class="btn btn-gradient-orange btn-glow rounded-circle subscribe-btn"><!-- <i class="ti-angle-right"></i> --></button>
                      </div>
                      <div class="all_errors username_error"></div>
                        <button type="submit" class="btn btn-lg btn-glow btn-gradient-orange btn-round animated forgot_password_btn" data-animation="fadeInUpShorter" data-animation-delay="1.1s">Send</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-8 mx-auto">
                  <p><span style="color: #FF4934;">For Login</span> <a href="<?php echo base_url('sign-in');?>">Click Here</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Contact -->

<script type="text/javascript">
$(document).ready(function(){

$(document).on('submit', '#forgotPasswordForm', function (e) {
    e.preventDefault();
    //$.LoadingOverlay("show");
    $('.forgot_password_btn').prop('disabled' , true);
    var obj = $(this);
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "auth/forgot_password_link",
        type: "POST",
        dataType: 'json',
        data: obj.serializeArray(),
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal({
                  title: "Success",
                  text: "An email sent to your email id please follow the link given in email to reset password within 50 minutes.",
                  icon: "success",
                  button: "Ok",
                });
            }
            else{
                errors(data.errors);
            }
        },
        complete: function(){
          $('.forgot_password_btn').prop('disabled' , false);
          //$.LoadingOverlay("hide");
        }
    });
    return false;
});

function errors(arr = ''){
  $.each(arr, function( key, value ) {
    $('.'+key+'_error').html(value);
  });
  return false;
}

});
</script>