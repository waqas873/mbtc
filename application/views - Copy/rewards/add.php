
<style type="text/css">
	#add_reward_form p{
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
			<span class="caption-subject font-red-sunglo bold uppercase">Add Reward</span>
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
		<form enctype="multipart/form-data" action="<?php echo base_url('rewards/process_add'); ?>" class="form-horizontal" id="add_reward_form" method="post">
			<div class="form-body">

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Right Investment:</label>
						<input type="number" name="reward_right_investment" value="<?php echo (set_value('reward_right_investment')) ? set_value('reward_right_investment') : (isset($data['reward_right_investment']) ? $data['reward_right_investment'] : ''); ?>" class="form-control" placeholder="Enter left investment">
						<?php echo form_error('reward_right_investment'); ?>
					</div>
					<div class="col-md-6">
						<label class="control-label">Left Investment:</label>
						<input type="number" name="reward_left_investment" value="<?php echo (set_value('reward_left_investment')) ? set_value('reward_left_investment') : (isset($data['reward_left_investment']) ? $data['reward_left_investment'] : ''); ?>" class="form-control" placeholder="Enter right investment">
						<?php echo form_error('reward_left_investment'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Reward Title:</label>
						<input type="text" name="reward_title" value="<?php echo (set_value('reward_title')) ? set_value('reward_title') : (isset($data['reward_title']) ? $data['reward_title'] : ''); ?>" class="form-control" placeholder="Enter title of reward ">
						<?php echo form_error('reward_title'); ?>
					</div>
					<div class="col-md-6">
						<label class="control-label">Reward Picture:</label>
						<input class="form-control placeholder-no-fix" type="file" name="reward_pic" />
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Add Reward" class="btn btn-primary">
					</div>

				</div>

			</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>