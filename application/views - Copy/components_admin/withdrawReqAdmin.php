<div>
	<h2 style="text-align:center;">Withraw</h2>
</div>
<div class="row" style="margin-top:10px;">
	<?php if($this->session->flashdata("success")){ ?>
		<div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("success"); ?></span>
        </div>
    <?php } ?>
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
				<th>Approve</th>
				<th>Reject</th>
				

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
				<td><?php echo $withdraw['id']; ?></td>
				<td><?php echo $withdraw['fullname']; ?></td>
				<td><?php echo $withdraw['username']; ?></td>
				<td><?php echo $withdraw['withdraw_amount']; ?></td>
				<td><?php echo $withdraw['requested_on']; ?></td>
				<td><?php echo $status; ?></td>
				<td><a href="<?php echo base_url('User/approve_withdraw/').$withdraw['withdraw_id']; ?>" class="btn btn-success">Approve</a></td>
					<td><a href="<?php echo base_url('User/reject_withdraw/').$withdraw['withdraw_id']; ?>" class="btn btn-danger">Reject</a></td>
			</tr>
		<?php }} ?>
		</tbody>
	</table>
</div>