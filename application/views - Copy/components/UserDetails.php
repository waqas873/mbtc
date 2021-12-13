<div class="row" style="overflow: hidden;">
	<h1 class="page-title">User Details</h1>
	<?php if($this->session->flashdata("success")){ ?>
		<div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata("success"); ?></span>
        </div>
    <?php } ?>
<table id="table"> 
	<thead>
		<tr>
			<th>Fullname</th>
			<th>Email</th>
			<th>Username</th>
			<th>Sponsor_code</th>
			<th>Parent</th>
			<th>Position</th>
			<th>Joined on</th>
			<th>Status</th>
			<th>Delete</th>
			<th>Block</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($user_details)) {
			foreach ($user_details as $key => $user) {
			$status = $user['status']?"Unblocked":"Blocked";	
				?>
		<tr>
			<td><?php echo $user['fullname']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['username']; ?></td>	
			<td><?php echo $user['sponsor_code']; ?></td>
			<td><?php echo $user['parent_name']; ?></td>
			<td><?php echo $user['position']; ?></td>
			<td><?php echo $user['created_at']; ?></td>
			<td><?php echo $status; ?></td>
			<td><a href="<?php echo base_url("User/delete/").$user['id']; ?>" class="btn btn-danger">Delete</a></td>
			<?php if ($status == "Blocked") { ?>
				<td><a href="<?php echo base_url("User/unblock/").$user['id']; ?>" class="btn btn-warning">Unblock</a></td>
			<?php }else{ ?>
			<td><a href="<?php echo base_url("User/block/").$user['id']; ?>" class="btn btn-warning">Block</a></td>
		<?php } ?>
		</tr>
	<?php }} ?>
	</tbody>
</table>
</div>