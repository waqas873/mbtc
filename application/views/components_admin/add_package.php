<div class="portlet light bordered">
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
		<form action="<?php echo base_url('User/Add_package'); ?>" class="form-horizontal" method="post">
			<div class="form-body">
				<div class="form-group">
					<label class="col-md-3 control-label">Package Name:</label>
					<div class="col-md-4">
						<input type="text" name="package_name" class="form-control" placeholder="Package Name">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Amount From:</label>
					<div class="col-md-4">
						<input type="number" name="package_amount_from" class="form-control" placeholder="Package Amount From">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Amount To:</label>
					<div class="col-md-4">
						<input type="number" name="package_amount_to" class="form-control" placeholder="Package Amount To">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Fees:</label>
					<div class="col-md-4">
						<input type="number" name="package_fees" class="form-control" placeholder="Package Fees">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Roi:</label>
					<div class="col-md-4">
						<input type="text" name="package_roi" class="form-control" placeholder="Package Roi">
						
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Package Colour:</label>
					<div class="col-md-4">
						<input type="color" name="package_color" class="form-control" placeholder="Package Colour">
						
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