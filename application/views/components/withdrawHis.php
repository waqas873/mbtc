<div>
	<h2 style="text-align:center;">Withraw History</h2>
</div>
<div class="row" style="margin-top:10px;">
	<table id="table">
		<thead>
			<tr>
			
				<th>Withdraw Id</th>
				<th>Withdraw Amount</th>
				<th>Requested on</th>
				<th>Approved on</th>
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
				<td><?php echo $withdraw['approved_on']; ?></td>
				<td><?php echo $status; ?></td>
				
			</tr>
		<?php }} ?>
		</tbody>
	</table>
</div>