<?php 
	foreach ($packages as $key => $package) {
		$package_name = $package['package_name'];
		$package_amount = $package['package_amount'];
		$package_fees = $package['package_fees'];
		$package_roi = $package['package_roi'];
		$package_color = $package['package_color'];
	}

 ?>
<div class="portlet light bordered">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer font-red-sunglo"></i>
			<span class="caption-subject font-red-sunglo bold uppercase">Update Package</span>
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
		<form action="<?php echo base_url('User/update_package'); ?>" class="form-horizontal" method="post">
			<input type="hidden" name="id" value="<?php echo $package['package_id']; ?>">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Package Name</label>
					<div class="col-md-4">
						<input type="text" name="package_name" class="form-control" placeholder="Package Name" value="<?php echo $package_name; ?>">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Amount</label>
					<div class="col-md-4">
						<input type="number" name="package_amount" class="form-control" placeholder="Package Amount" value="<?php echo $package_amount; ?>">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Fees</label>
					<div class="col-md-4">
						<input type="number" name="package_fees" class="form-control" placeholder="Package Fees" value="<?php echo $package_fees; ?>">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Roi</label>
					<div class="col-md-4">
						<input type="number" name="package_roi" class="form-control" placeholder="Package Roi" value="<?php echo $package_roi; ?>">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Colour</label>
					<div class="col-md-4">
						<input type="color" name="package_color" class="form-control" placeholder="Package Colour" value="<?php echo $package_color; ?>">
						
					</div>

				</div>
				<div class="form-group">
					<div class="col-md-offset-3 col-md-4">
						<input type="submit" value="Add Package" class="btn btn-primary">
					</div>

				</div>

			</div>
						</form>
						<!-- END FORM-->
					</div>
				</div>