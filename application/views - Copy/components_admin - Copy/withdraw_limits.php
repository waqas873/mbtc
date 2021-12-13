	<?php foreach ($withdraw_controls as $key => $withdraw) {
		$min_withdraw = $withdraw['min_withdraw'];
		$max_withdraw = $withdraw['max_withdraw'];
		$withdraw_open = $withdraw['withdraw_open'];
		$withdraw_close = $withdraw['withdraw_close'];

	} ?>

<div class="row">
	<div class="col-md-12" style="background: #364151;color: white;text-align: center;line-height:30px;">
		<?php if($this->session->flashdata("success")){ ?>
		<div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("success"); ?></span>
        </div>
    <?php } ?>
		<h2>Withdraw Limits</h2>
		<form action="<?php echo base_url("User/withdraw_lim_update") ?>" method="post">
			<div class="form-group">
				<label>
					Minimum Withdraw:
				<input type="number" name="min" class="form-control" placeholder="Min" value="<?php echo $min_withdraw; ?>">
				</label>
			</div>
			<div class="form-group">
				<label>
					Max Withdraw:
				<input type="number" name="max" class="form-control" placeholder="Max" value="<?php echo $max_withdraw; ?>">
				</label>
			</div>
			<div class="form-group">
				<label>
					Opening Date:
				<input type="date" name="opening" class="form-control" value="<?php echo $withdraw_open; ?>">
				</label>
			</div>
			<div class="form-group">
				<label>
					Closing Date:
				<input type="date" name="closing" class="form-control" value="<?php echo $withdraw_close; ?>">
				</label>
			</div>
			<input type="submit" value="Update" class="btn btn-success" style="margin-bottom: 10px;">
		</form>
	</div>	
</div>