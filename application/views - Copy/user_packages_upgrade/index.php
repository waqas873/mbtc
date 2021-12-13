
<style type="text/css">
	.caption_color{
		color: #36C6D3 !important;
	}
	.text_center{
		text-align: center;
	}
	.border_radius{
		border-radius: 8px !important;
	}
    .label_style{
       border-radius: 5px !important;   
    }
</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase">Packages Upgrade Requests</span>
		</div>

	</div>
	<div class="portlet-body form">

	<?php if($this->session->flashdata("success_message")){ ?>
		<div class="alert alert-success shadow">
            <button class="close" data-close="alert"></button>
            <strong>Success! </strong><span><?php echo $this->session->flashdata("success_message"); ?></span>
        </div>
    <?php } ?>
    <?php if($this->session->flashdata("error_message")){ ?>
		<div class="alert alert-danger shadow">
            <button class="close" data-close="alert"></button>
            <strong>Warning! </strong><span><?php echo $this->session->flashdata("error_message"); ?></span>
        </div>
    <?php } ?>


    <div class="row">
    <div class="col-md-12">
        <div class="point_status_tbl2">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption text_shadow">All Packages</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            
                            <a href="javascript:;" class="reload"> </a>
                            
                        </div>
                    </div>
                    <div class="portlet-body">

                    	
                        <div class="table-responsive" style="overflow-x: hidden !important;">
                            <table class="table table-striped dt-responsive" id="sample_3" style="border-bottom: none !important;">
                                <thead>
                                    <tr class="table_heading">
                                    	<th class="text_center">Sr No</th>
                                        <th class="text_center">User Name</th>
										<th class="text_center">Email</th>
										<th class="text_center">New Package</th>
                                        <th class="text_center">Amount</th>
										<th class="text_center">Previous Package</th>
                                        <th class="text_center">Amount</th>
										<th class="text_center">Date</th>
                                        <th class="text_center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       if(isset($packages) && !empty($packages)) { 
                                        $index = 1;
                                        foreach ($packages as $package) {
                                    ?>
                                    <tr class="table_text_shadow">
                                    	<td class="text_center"><?php echo $index; ?></td>
                                        <td class="text_center"><?php echo ucwords($package['fullname']); ?></td>
										<td class="text_center"><?php echo $package['email']; ?></td>
										<td class="text_center"><?php echo $package['package_name']; ?></td>
										<td class="text_center"><?php echo "$".$package['upu_package_amount']; ?></td>
										<td class="text_center"><?php echo $package['previous_package_name']; ?></td>
                                        <td class="text_center"><?php echo "$".$package['up_package_amount']; ?></td>
                                        <td class="text_center">
                                            <?php 
                                                $datetime = explode(' ', $package['upu_created_at']);
                                                $date = $datetime[0];
                                                echo $date; 
                                            ?>
                                        </td>
                                        <td class="text_center">
                                            <div style="width: 145px; margin: auto;">
                                            <a href="<?php echo base_url("user_packages_upgrade/approve_request/").$package['upu_id']; ?>" class="btn btn-success btn-sm border_radius" onclick="delete_record(this, 'user_packages'); return false;">Approve</a>
                                            <a href="<?php echo base_url("user_packages_upgrade/reject_request/").$package['upu_id']; ?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'user_packages'); return false;">Reject</a>
                                            </div>
										</td>
                                    </tr>
                                    <?php 
                                          $index++; 
                                        } 
                                       } 
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	</div>
</div>
