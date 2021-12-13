
<style type="text/css">
	#update_limit_form p{
		color: red;
	}
	.form-body{
		width: 80%;
		margin:0 auto;
	}
</style>

<div class="portlet light bordered shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer font-red-sunglo"></i>
			<span class="caption-subject font-red-sunglo bold uppercase">Update Withdraw Limints</span>
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
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url('withdraws/process_withdraw_limits'); ?>" class="form-horizontal" id="update_limit_form" method="post" novalidate>

			<input value="<?php echo (set_value('wl_id')) ? set_value('wl_id') : (isset($data['wl_id']) ? $data['wl_id'] : ''); ?>" type="hidden" name="wl_id" />

			<div class="form-body">
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Minimum Withdraw:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('min_withdraw')) ? set_value('min_withdraw') : (isset($data['min_withdraw']) ? $data['min_withdraw'] : ''); ?>" type="number" placeholder="Enter Minimum Withdraw" name="min_withdraw" required />
 		                <?php echo form_error('min_withdraw');?> 
					</div>
					<div class="col-md-6">
						<label class="control-label">Maximum Withdraw:<span style="color: #143148;">*</span></label>
						<input class="form-control placeholder-no-fix" value="<?php echo (set_value('max_withdraw')) ? set_value('max_withdraw') : (isset($data['max_withdraw']) ? $data['max_withdraw'] : ''); ?>" type="number" autocomplete="off" placeholder="Enter Maximum Withdraw" name="max_withdraw"  required /> 
 				        <?php echo form_error('max_withdraw');?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Update Limits" class="btn btn-primary">
					</div>
				</div>

			</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>