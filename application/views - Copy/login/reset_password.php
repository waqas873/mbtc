<style type="text/css">
    #reset_password_form p{
        color: red;
    }
</style>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" id="reset_password_form" action="<?php echo base_url('Login/process_reset_password'); ?>" method="post">
        <h3 class="form-title font-green">Reset Password</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter New Password. </span>
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
        
        <input value="<?php echo (set_value('sponsor_code')) ? set_value('sponsor_code') : (isset($sponsor_code) ? $sponsor_code : ''); ?>" type="hidden" name="sponsor_code"  required /> 

        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">New Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="New Password" name="password" /> 
            <?php echo form_error('password');?>
        </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Confirm Password" name="cpassword" /> 
                <?php echo form_error('cpassword');?>
            </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Reset Password</button>
                    <a href="<?php echo base_url('login/index/');?>" id="forget-password" class="forget-password">login?</a>
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
            