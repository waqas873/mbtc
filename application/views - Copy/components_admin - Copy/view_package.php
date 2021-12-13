<div class="row">
	<h1 class="page-title">User Packages</h1>
<table id="table"> 
	<thead>
		<tr>
			<th>Package Id</th>
			<th>Package Name</th>
			<th>Package Amount</th>
			<th>Package Roi</th>
			<th>Package Fees</th>
			<th>Package Color</th>
			<th>Created at</th>
			<th>Delete</th>
			<th>Update</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($packages)) {
			foreach ($packages as $key => $package) {
		 ?>
		<tr>
			<td><?php echo $package['package_id']; ?></td>
			<td><?php echo $package['package_name']; ?></td>
			<td><?php echo $package['package_amount']; ?></td>
			<td><?php echo $package['package_roi']; ?></td>
			<td><?php echo $package['package_fees']; ?></td>
			<td><div style="height:35px;width:35px;border-radius:200px !important;background:<?php echo $package['package_color']; ?>;"></div></td>
			<td><?php echo $package['created_at']; ?></td>
			<td><a href="<?php echo base_url("User/delete_package/").$package['package_id']; ?>" class="btn btn-danger">Delete</a></td>
			<td><a href="<?php echo base_url("User/viewpackages/").$package['package_id']; ?>" class="btn btn-success">Update</a></td>
		</tr>
	<?php }} ?>
	</tbody>
</table>
</div>