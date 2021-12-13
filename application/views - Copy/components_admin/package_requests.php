<div class="row">
	<h1 class="page-title">User Package Requests</h1>
	<?php if($this->session->flashdata("success")){ ?>
		<div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("success"); ?></span>
        </div>
    <?php } ?>
<table id="table"> 
	<thead>
		<tr>
			<th>User Id</th>
			<th>Username</th>
			<th>Fullname</th>
			<th>Pacakge Id</th>
			<th>Package Name</th>
			<th>Package Amount</th>
			<th>Package Fees</th>
			<th>Package Roi</th>
			<th>Status</th>
			<th>Approve</th>
			<th>Reject</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($package_request)) {
			foreach ($package_request as $key => $package_req) {
				$status = ($package_req['user_package_status'] == 0)?'<span class="label label-sm label-info"> Pending </span>':'<span class="label label-sm label-danger"> Rejected </span>'; 
		 ?>
		<tr>
			<td><?php echo $package_req['id']; ?></td>
			<td><?php echo $package_req['username']; ?></td>
			<td><?php echo $package_req['fullname']; ?></td>
			<td><?php echo $package_req['package_id']; ?></td>
			<td><?php echo $package_req['package_name']; ?></td>
			<td><?php echo $package_req['package_amount']; ?></td>
			<td><?php echo $package_req['package_fees']; ?></td>
			<td><?php echo $package_req['package_roi']; ?></td>
			<td><?php echo $status; ?></td>
			<td><a href="<?php echo base_url()."User/approvePackage/".$package_req['up_id'].'/'.$package_req['id'].'/'.$package_req['package_id']; ?>">Approve</a></td>
			<td><a href="<?php echo base_url()."User/rejectPackage/".$package_req['up_id'].'/'.$package_req['id'].'/'.$package_req['package_id']; ?>">Reject</a></td>
		</tr>
	<?php }} ?>
	</tbody>
</table>
</div>