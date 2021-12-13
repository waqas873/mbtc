<style>
	#error{
		color:red;
	}
</style>

<div class="row">
	<?php 
	$open = $withdraw_controls[0]['withdraw_open'];
	$close = $withdraw_controls[0]['withdraw_close'];
	$today = date("Y-m-d");

			if ($today >= $open && $today <= $close) {
			
	 ?>
	<div class="col-md-offset-4 col-md-4 col-md-offset-4">

		<div style="text-align: center;">
			<div class="alert alert-success" id="withdraw_alert">
            <button class="close" data-close="alert"></button>
            <span>Your request has been sent to admin for Approval!!</span>
        </div>

			<form action="javascript:;" method="post">
				<input type="hidden" value="<?php echo $withdraw_controls[0]['min_withdraw'] ?>" id="min">
					<input type="hidden" value="210" id="user_bal">
				<input type="hidden" value="<?php echo $withdraw_controls[0]['max_withdraw'] ?>" id="max">

				<input type="number" placeholder="Withdraw Amount" name="withdraw_amount" style="width: 100%;" class="form-control">
				<p id="error"></p>
				<br>
				<a href="javascript:;" class="btn btn-primary" id="withdraw_btn">Withdraw</a>
			</form>
		</div>
	</div>
	<?php }else{
			echo "<h2 style='text-align:center;color:red;'>Withraw is Closed at the moment</h2>";
			} ?>
</div>
<div>
	<h2 style="text-align:center;">Withraw History</h2>
</div>
<div class="row" style="margin-top:10px;" id="dataload">
	<table class="table table-hover table-striped table-responsive" id="dataReload">
		<thead>
			<tr>
			
				<th>Withdraw Id</th>
				<th>Withdraw Amount</th>
				<th>Requested on</th>
				<th>Withdraw Status</th>
				

			</tr>
		</thead>
		<tbody>
			<?php if (!empty($withdraws)) {
				foreach ($withdraws as $key => $withdraw) {
					$withdraw_status = $withdraw['withdraw_status'];
					if ($withdraw_status == 0) {
				$status = "<span class='badge badge-warning'>Pending</span>";
					}
					if ($withdraw_status == 1) {
				$status = "<span class='badge badge-success'>Approved</span>";
					}
					if ($withdraw_status == 2) {
				$status = "<span class='badge badge-danger'>Rejected</span>";
					}
		
			 ?>
			<tr>
				<td><?php echo $withdraw['withdraw_id']; ?></td>
				<td><?php echo $withdraw['withdraw_amount']; ?></td>
				<td><?php echo $withdraw['requested_on']; ?></td>
				<td><?php echo $status; ?></td>
				
			</tr>
		<?php }} ?>
		</tbody>
	</table>
</div>


