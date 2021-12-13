<div class="row">
	<h1 class="page-title">User Packages</h1>
<table id="table"> 
	<thead>
		<tr>
			<th>Package Id</th>
			<th>User Id</th>
			<th>User Fullname</th>
			<th>Username</th>
			<th>Package Name</th>
			<th>Package Fees</th>
			<th>Package Roi</th>
			<th>Bought On</th>
			
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($packages)) {
			foreach ($packages as $key => $packages) {
		?>
		<tr>
			<td><?php echo $packages['package_id']; ?></td>
			<td><?php echo $packages['id']; ?></td>
			<td><?php echo $packages['fullname']; ?></td>
			<td><?php echo $packages['username']; ?></td>
			<td><?php echo $packages['package_name']; ?></td>	
			<td><?php echo $packages['package_fees']; ?></td>
			<td><?php echo $packages['package_roi']; ?></td>
			<td><?php echo $packages['created_at']; ?></td>
			
		</tr>
	<?php }}?>
	</tbody>
</table>
</div>