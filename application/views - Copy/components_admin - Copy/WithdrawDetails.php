<div class="portlet-body">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#tab_1_1" data-toggle="tab" aria-expanded="true"> Approved Withdraws</a>
		</li>
		<li class="">
			<a href="#tab_1_2" data-toggle="tab" aria-expanded="false"> Rejected Withdraws</a>
		</li>

	</ul>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="tab_1_1">
				<table id="table">
		<thead>
			<tr>
				
				<th>Withdraw Id</th>
				<th>User Id</th>
				<th>Fullname</th>
				<th>Username</th>
				<th>Withdraw Amount</th>
				<th>Requested on</th>
				<th>Withdraw Status</th>
				<!-- <th>Approve</th>
				<th>Reject</th> -->
				

			</tr>
		</thead>
		<tbody>
			<?php if (!empty($approved)) {
				foreach ($approved as $key => $withdraw) {
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
				<td><?php echo $withdraw['id']; ?></td>
				<td><?php echo $withdraw['fullname']; ?></td>
				<td><?php echo $withdraw['username']; ?></td>
				<td><?php echo $withdraw['withdraw_amount']; ?></td>
				<td><?php echo $withdraw['requested_on']; ?></td>
				<td><?php echo $status; ?></td>
				<!-- <td><a href="<?php echo base_url('User/approve_withdraw/').$withdraw['withdraw_id']; ?>" class="btn btn-success">Approve</a></td>
					<td><a href="<?php echo base_url('User/reject_withdraw/').$withdraw['withdraw_id']; ?>" class="btn btn-danger">Reject</a></td> -->
			</tr>
		<?php }} ?>
		</tbody>
	</table>
		</div>
		<div class="tab-pane fade" id="tab_1_2">
	<table id="table2">
		<thead>
			<tr>
				
				<th>Withdraw Id</th>
				<th>User Id</th>
				<th>Fullname</th>
				<th>Username</th>
				<th>Withdraw Amount</th>
				<th>Requested on</th>
				<th>Withdraw Status</th>
				<!-- <th>Approve</th>
				<th>Reject</th> -->
				

			</tr>
		</thead>
		<tbody>
			<?php if (!empty($rejected)) {
				foreach ($rejected as $key => $withdraw) {
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
				<td><?php echo $withdraw['id']; ?></td>
				<td><?php echo $withdraw['fullname']; ?></td>
				<td><?php echo $withdraw['username']; ?></td>
				<td><?php echo $withdraw['withdraw_amount']; ?></td>
				<td><?php echo $withdraw['requested_on']; ?></td>
				<td><?php echo $status; ?></td>
				<!-- <td><a href="<?php echo base_url('User/approve_withdraw/').$withdraw['withdraw_id']; ?>" class="btn btn-success">Approve</a></td>
					<td><a href="<?php echo base_url('User/reject_withdraw/').$withdraw['withdraw_id']; ?>" class="btn btn-danger">Reject</a></td> -->
			</tr>
		<?php }} ?>
		</tbody>
	</table>
		</div>

	</div>
	<div class="clearfix margin-bottom-20"> </div>

</div>