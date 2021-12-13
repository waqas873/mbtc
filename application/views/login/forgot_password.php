
<style type="text/css">
    #forgot_form p{
       color: red;
    }
</style>

<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" id="forgot_form" action="<?php echo base_url('Login/process_forgot_password'); ?>" method="post">
        <h3 class="form-title font-green">Forgot Password</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter Email. </span>
        </div>
        
        
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

        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Enter Email" name="email" /> 
            <?php echo form_error('email');?>
        </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Submit</button>
                    <!-- <label class="rememberme check mt-checkbox mt-checkbox-outline">
                        <input type="checkbox" name="remember" value="1" />Remember
                        <span></span>
                    </label> -->
                    <a href="<?php echo base_url('login/index/');?>" id="forget-password" class="forget-password">Login?</a>
                </div>
                
            </form>
            <div class="create-account">
                <p>
                    <a href="<?php echo base_url('login/signup');?>" class="uppercase">Create an account</a>
                </p>
            </div>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            
               
            </div>
            