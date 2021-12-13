
<style type="text/css">
	#add_package_form p{
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
			<span class="caption-subject font-red-sunglo bold uppercase">Add Package</span>
		</div>

	</div>
	<div class="portlet-body form">
		<?php if($this->session->flashdata("msg")){ ?>
		<div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("msg"); ?></span>
        </div>
    <?php } ?>
		<!-- BEGIN FORM-->
		<form action="<?php echo base_url('packages/process_add'); ?>" class="form-horizontal" id="add_package_form" method="post">
			<div class="form-body">
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Package Name:</label>
						<input type="text" name="package_name" value="<?php echo (set_value('package_name')) ? set_value('package_name') : (isset($data['package_name']) ? $data['package_name'] : ''); ?>" class="form-control" placeholder="Enter Package Name">
						<?php echo form_error('package_name'); ?>
					</div>
					<div class="col-md-6">
						<label class="control-label">Minimum Amount:</label>
						<input type="number" name="package_min_amount" value="<?php echo (set_value('package_min_amount')) ? set_value('package_min_amount') : (isset($data['package_min_amount']) ? $data['package_min_amount'] : ''); ?>" class="form-control" placeholder="Enter Minimum Package Amount">
						<?php echo form_error('package_min_amount'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Maximum Amount:</label>
						<input type="number" name="package_max_amount" value="<?php echo (set_value('package_max_amount')) ? set_value('package_max_amount') : (isset($data['package_max_amount']) ? $data['package_max_amount'] : ''); ?>" class="form-control" placeholder="Enter Maximum Package Amount ">
						<?php echo form_error('package_max_amount'); ?>
					</div>
					<div class="col-md-6">
						<label class="control-label">Package Fees:</label>
						<input type="number" name="package_fees" value="<?php echo (set_value('package_fees')) ? set_value('package_fees') : (isset($data['package_fees']) ? $data['package_fees'] : ''); ?>" class="form-control" placeholder="Enter Package Fees">
						<?php echo form_error('package_fees'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Package Roi:</label>
						<input type="text" name="package_roi" value="<?php echo (set_value('package_roi')) ? set_value('package_roi') : (isset($data['package_roi']) ? $data['package_roi'] : ''); ?>" class="form-control" placeholder="Enter Package Roi">
						<?php echo form_error('package_roi'); ?>
					</div>
					<div class="col-md-4">
						<label class="control-label">Package Colour:</label>
						<input type="color" name="package_color" value="<?php echo (set_value('package_color')) ? set_value('package_color') : (isset($data['package_color']) ? $data['package_color'] : ''); ?>" class="form-control" placeholder="Package Colour">
						<?php echo form_error('package_color'); ?>
					</div>

				</div>
				<div class="form-group">
					<div class="col-md-4">
						<input type="submit" value="Add Package" class="btn btn-primary">
					</div>

				</div>

			</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>